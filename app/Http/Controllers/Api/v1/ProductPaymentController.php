<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:58:19
 * File: ProductPayment.php
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\Member;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductPayment;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreProductPaymentRequest;

class ProductPaymentController extends Controller
{
    /**
     * ProductPayment constructor.
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
            $ascending = (int) $request->get('ascending', 0);
            $orderBy = $request->get('orderBy', '');
            $search = $request->get('search', '');
            $betweenDate = $request->get('updated_at', []);

            $queryService = new QueryService(new ProductPayment());
            $queryService->select = [];
            $queryService->columnSearch = [];
            $queryService->withRelationship = ['product', 'size', 'color', 'member'];
            $queryService->search = $search;
            $queryService->betweenDate = $betweenDate;
            $queryService->limit = $limit;
            $queryService->ascending = $ascending;
            $queryService->orderBy = $orderBy;

            $query = $queryService->queryTable();
            $query = $query->paginate($limit);
            $productPayment = $query->toArray();

            return $this->jsonTable($productPayment);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * create
     * @param Request $request
     * @return JsonResponse
     * @author tanmnt
     */
    public function store(Request $request): JsonResponse
    {
        $productDetail = ProductDetail::productDetail($request);
        if (!$productDetail) {
            return $this->jsonMessage(trans('messages.404'), false, Response::HTTP_NOT_FOUND);
        }
        $this->validate($request, [
            'total' => [
                'nullable',
                'numeric',
                function ($attribute, $value, $fail) use($productDetail) {
                    if ($productDetail->amount < $value) {
                        $fail(trans('validation.max.numeric', ['max' => $productDetail->amount]));
                    }
                },
            ],
            'note' => 'nullable|string',
        ]);
        try {
            \DB::transaction();
            $requestAll = $request->all();
            $requestAll['product_detail_id'] = $productDetail->id;
            $requestAll['price'] = $productDetail->price * $requestAll['total'];
            $productPayment = new ProductPayment();
            $productPayment->fill($requestAll);
            $productPayment->save();
            $productDetail->amount > ProductDetail::OUT_STOCK && $productDetail->decrement('amount', $requestAll['total']);
            $product = Product::find($request->get('product_id'));
            if ($product) {
                $product->stock_out += $requestAll['total'];
                $product->inventory = $product->stock_in - $product->stock_out;
                $product->save();
            }
            $member = Member::find($requestAll['member_id']);
            $member && $member->increment('amount', $requestAll['total']);
            \DB::commit();
            //{{CONTROLLER_RELATIONSHIP_MTM_CREATE_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($productPayment, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            \DB::rollback();
            return $this->jsonError($e);
        }
    }

    /**
     * get once by id
     * @param ProductPayment $productPayment
     * @return JsonResponse
     * @author tanmnt
     */
    public function show(ProductPayment $productPayment): JsonResponse
    {
        try {
            //{{CONTROLLER_RELATIONSHIP_MTM_SHOW_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($productPayment);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * update once by id
     * @param StoreProductPaymentRequest $request
     * @param ProductPayment $productPayment
     * @return JsonResponse
     * @author tanmnt
     */
    public function update(StoreProductPaymentRequest $request, ProductPayment $productPayment): JsonResponse
    {
        try {
            $productPayment->fill($request->all());
            $productPayment->save();
            //{{CONTROLLER_RELATIONSHIP_MTM_UPDATE_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($productPayment);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * delete once by id
     * @param ProductPayment $productPayment
     * @return JsonResponse
     * @author tanmnt
     */
    public function destroy(ProductPayment $productPayment): JsonResponse
    {
        try {
            //{{CONTROLLER_RELATIONSHIP_MTM_DELETE_NOT_DELETE_THIS_LINE}}
            $productPayment->delete();

            return $this->jsonMessage(trans('messages.delete'));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * @param Request $request
     * @param ProductPayment $productPayment
     * @return JsonResponse
     */
    public function rollback(Request $request, ProductPayment $productPayment): JsonResponse
    {
        try {
            \DB::beginTransaction();
            $total = $request->get('total');
            $productDetail = ProductDetail::find($request->get('product_detail_id'));
            $productDetail && $productDetail->increment('amount', $total);
            $product = Product::find($request->get('product_id'));
            if ($product) {
                $product->stock_out = $product->stock_out > ProductDetail::OUT_STOCK ? $product->stock_out - $total : ProductDetail::OUT_STOCK;
                $product->inventory = $product->stock_in - $product->stock_out;
                $product->save();
            }
            $member = Member::find($request->get('member_id'));
            $member && $member->amount > ProductDetail::OUT_STOCK && $member->decrement('amount', $total);
            $productPayment->delete();
            \DB::commit();

            return $this->jsonMessage(trans('messages.delete'));
        } catch (\Exception $e) {
            \DB::rollBack();
            return $this->jsonError($e);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function exportExcel(Request $request): JsonResponse
    {
        try {
            set_time_limit(0);
            $productPayment = \DB::table('product_payments as prop')
                ->select([
                    'prop.id',
                    'prop.total',
                    'prop.price',
                    'products.name as product_name',
                    'sizes.name as size_name',
                    'colors.name as color_name',
                    'members.name as member_name',
                    'prop.note',
                    'prop.updated_at',
                ])
                ->leftJoin('products', 'products.id', 'prop.product_id')
                ->leftJoin('sizes', 'sizes.id', 'prop.size_id')
                ->leftJoin('colors', 'colors.id', 'prop.color_id')
                ->leftJoin('members', 'members.id', 'prop.member_id')
                ->get();

            return $this->jsonData($productPayment);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    //{{CONTROLLER_RELATIONSHIP_NOT_DELETE_THIS_LINE}}
}
