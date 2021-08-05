<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-05 21:05:22
 * File: ProductDetail.php
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\ProductDetail;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreProductDetailRequest;

class ProductDetailController extends Controller
{
    /**
     * ProductDetail constructor.
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

			$queryService = new QueryService(new ProductDetail);
            $queryService->select = [];
            $queryService->columnSearch = [];
            $queryService->withRelationship = [];
            $queryService->search = $search;
            $queryService->betweenDate = $betweenDate;
            $queryService->limit = $limit;
            $queryService->ascending = $ascending;
            $queryService->orderBy = $orderBy;

            $query = $queryService->queryTable();
            $query = $query->paginate($limit);
            $productDetail = $query->toArray();

			return $this->jsonTable($productDetail);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * create
	 * @param StoreProductDetailRequest $request
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function store(StoreProductDetailRequest $request): JsonResponse
	{
		try {
		    $productDetail = new ProductDetail();
		    $productDetail->fill($request->all());
            $productDetail->save();
			//{{CONTROLLER_RELATIONSHIP_MTM_CREATE_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($productDetail, Response::HTTP_CREATED);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * get once by id
	 * @param ProductDetail $productDetail
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function show(ProductDetail $productDetail): JsonResponse
	{
		try {
		    //{{CONTROLLER_RELATIONSHIP_MTM_SHOW_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($productDetail);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * update once by id
	 * @param StoreProductDetailRequest $request
	 * @param ProductDetail $productDetail
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function update(StoreProductDetailRequest $request, ProductDetail $productDetail): JsonResponse
	{
		try {
		    $productDetail->fill($request->all());
            $productDetail->save();
            //{{CONTROLLER_RELATIONSHIP_MTM_UPDATE_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($productDetail);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * delete once by id
	 * @param ProductDetail $productDetail
	 * @return JsonResponse
	 * @author tanmnt
	 */
    public function destroy(ProductDetail $productDetail): JsonResponse
    {
	    try {
	        //{{CONTROLLER_RELATIONSHIP_MTM_DELETE_NOT_DELETE_THIS_LINE}}
			$productDetail->delete();

		    return $this->jsonMessage(trans('messages.delete'));
	    } catch (\Exception $e) {
	    	return $this->jsonError($e);
	    }
    }

    //{{CONTROLLER_RELATIONSHIP_NOT_DELETE_THIS_LINE}}
}
