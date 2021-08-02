<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:58:19
 * File: ProductPayment.php
 */

namespace App\Http\Controllers\Api\v1;

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
            $queryService->withRelationship = ['product','size','color'];
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
     * @param StoreProductPaymentRequest $request
     * @return JsonResponse
     * @author tanmnt
     */
    public function store(StoreProductPaymentRequest $request): JsonResponse
    {
        try {
            $productPayment = new ProductPayment();
            $productPayment->fill($request->all());
            $productPayment->save();
            //{{CONTROLLER_RELATIONSHIP_MTM_CREATE_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($productPayment, Response::HTTP_CREATED);
        } catch (\Exception $e) {
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

    //{{CONTROLLER_RELATIONSHIP_NOT_DELETE_THIS_LINE}}
}
