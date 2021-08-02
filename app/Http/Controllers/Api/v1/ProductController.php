<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:53:12
 * File: Product.php
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\Product;
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
            $queryService->columnSearch = [];
            $queryService->withRelationship = ['colors','sizes'];
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
		    $product = new Product();
		    $product->fill($request->all());
            $product->save();
			$colorId = $request->get('color_id', []);
            if($colorId) {
                $product->colors()->attach($colorId);
            }
            $sizeId = $request->get('size_id', []);
            if($sizeId) {
                $product->sizes()->attach($sizeId);
            }
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
		    $product->color_id = \Arr::pluck($product->colors()->get(), 'pivot.color_id');
            $product->size_id = \Arr::pluck($product->sizes()->get(), 'pivot.size_id');
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
            $product->save();
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
