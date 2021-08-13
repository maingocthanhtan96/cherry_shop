<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:53:12
 * File: Product.php
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\Color;
use App\Models\Member;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Product constructor.
     * @author tanmnt
     */
    function __construct()
    {
        $this->middleware('permission:' . \ACL::PERMISSION_VISIT, ['only' => ['index']]);
        $this->middleware('permission:' . \ACL::PERMISSION_CREATE, ['only' => ['store']]);
        $this->middleware('permission:' . \ACL::PERMISSION_EDIT, ['only' => ['show', 'update']]);
        $this->middleware('permission:' . \ACL::PERMISSION_DELETE, ['only' => ['destroy']]);
    }

	/**
	 * lists
	 * @param Request $request
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function index(Request $request): JsonResponse
	{
		try {
			$limit = $request->get('limit', 25);
			$ascending = (int)$request->get('ascending', 0);
			$orderBy = $request->get('orderBy', '');
			$search = $request->get('search', '');
			$betweenDate = $request->get('updated_at', []);

			$queryService = new QueryService(new Product);
            $queryService->select = [];
            $queryService->columnSearch = ['name', 'code'];
            $queryService->withRelationship = ['category', 'productDetails.size', 'productDetails.color'];
            $queryService->search = $search;
            $queryService->betweenDate = $betweenDate;
            $queryService->limit = $limit;
            $queryService->ascending = $ascending;
            $queryService->orderBy = $orderBy;

            $query = $queryService->queryTable();
            $query = $query->paginate($limit);
            $product = $query->toArray();

			return $this->jsonTable($product);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * create
	 * @param StoreProductRequest $request
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function store(StoreProductRequest $request): JsonResponse
	{
		try {
            $requestAll = $request->all();
            $requestAll['stock_out'] = 0;
            $requestAll['inventory'] = 0;
            $productDetails = json_decode($requestAll['product_details'], true) ?? [];
            $stockIn = collect($productDetails)->sum('amount');
            $requestAll['stock_in'] = $stockIn;
		    $product = new Product();
		    $product->fill($requestAll);
            if ($request->hasFile('image')) {
                $disk = \Storage::disk();
                $fileName = $disk->putFile(Product::FOLDER_UPLOAD, $request->file('image'));
                $product->image = $disk->url($fileName);
            }
            $product->save();
            foreach ($productDetails as $key => $detail) {
                $productDetails[$key]['product_id'] = $product->id;
                $stockIn += $detail['amount'];
            }
            ProductDetail::upsert($productDetails, ['color_id', 'size_id', 'product_id'], ['amount', 'price']);
            //{{CONTROLLER_RELATIONSHIP_MTM_CREATE_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($product, Response::HTTP_CREATED);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * get once by id
	 * @param Product $product
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function show(Product $product): JsonResponse
	{
		try {
		    $product->load('productDetails');
            //{{CONTROLLER_RELATIONSHIP_MTM_SHOW_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($product);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * update once by id
	 * @param StoreProductRequest $request
	 * @param Product $product
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function update(StoreProductRequest $request, Product $product): JsonResponse
	{
		try {
            $product->fill($request->all());
            if ($request->hasFile('image')) {
                $disk = \Storage::disk();
                $fileName = $disk->putFile(Product::FOLDER_UPLOAD, $request->file('image'));
                $urlImage = parse_url($product->image, PHP_URL_PATH);
                if ($disk->exists($urlImage)) {
                    $disk->delete($urlImage);
                }
                $product->image = $disk->url($fileName);
            }
            $product->save();
            $productDetails = json_decode($request->get('product_details'), true) ?? [];
            foreach ($productDetails as $key => $detail) {
                unset($productDetails[$key]['created_at']);
                $productDetails[$key]['updated_at'] = now();
            }
            ProductDetail::upsert($productDetails, ['color_id', 'size_id', 'product_id'], ['amount', 'price']);
            $colorId = $request->get('color_id', []);
            if($colorId) {
                $product->colors()->sync($colorId);
            }
            $sizeId = $request->get('size_id', []);
            if($sizeId) {
                $product->sizes()->sync($sizeId);
            }
            //{{CONTROLLER_RELATIONSHIP_MTM_UPDATE_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($product);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * delete once by id
	 * @param Product $product
	 * @return JsonResponse
	 * @author tanmnt
	 */
    public function destroy(Product $product): JsonResponse
    {
	    try {
	        $disk = \Storage::disk();
            $urlImage = parse_url($product->image, PHP_URL_PATH);
            if ($disk->exists($urlImage)) {
                $disk->delete($urlImage);
            }
	        $product->colors()->detach();
            $product->sizes()->detach();
            //{{CONTROLLER_RELATIONSHIP_MTM_DELETE_NOT_DELETE_THIS_LINE}}
			$product->delete();

		    return $this->jsonMessage(trans('messages.delete'));
	    } catch (\Exception $e) {
	    	return $this->jsonError($e);
	    }
    }

    /**
     * @param $product
     * @return JsonResponse
     */
    public function detail($product): JsonResponse
    {
        try {
            $productDetails = ProductDetail::where('product_id', $product)
                ->where('amount', '>', ProductDetail::OUT_STOCK)
                ->get()
                ->toArray();
            $sizesId = array_unique(\Arr::pluck($productDetails, 'size_id'));
            $colorsId = array_unique(\Arr::pluck($productDetails, 'color_id'));
            $sizes = Size::find($sizesId);
            $colors = Color::find($colorsId);
            $members = Member::latest('amount')->limit(Member::ORDER_AMOUNT)->get();

            return $this->jsonData([
                'sizes' => $sizes,
                'colors' => $colors,
                'members' => $members,
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * get all data from Product
     * @return JsonResponse
     */
    public function getProduct(): JsonResponse
    {
        try {
            $products = Product::all();

            return $this->jsonData($products);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    //{{CONTROLLER_RELATIONSHIP_NOT_DELETE_THIS_LINE}}
}
