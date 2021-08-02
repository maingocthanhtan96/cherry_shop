<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:00:29
 * File: ProductReject.php
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\ProductReject;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreProductRejectRequest;

class ProductRejectController extends Controller
{
    /**
     * ProductReject constructor.
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

			$queryService = new QueryService(new ProductReject);
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
            $productReject = $query->toArray();

			return $this->jsonTable($productReject);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * create
	 * @param StoreProductRejectRequest $request
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function store(StoreProductRejectRequest $request): JsonResponse
	{
		try {
		    $productReject = new ProductReject();
		    $productReject->fill($request->all());
            $productReject->save();
			//{{CONTROLLER_RELATIONSHIP_MTM_CREATE_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($productReject, Response::HTTP_CREATED);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * get once by id
	 * @param ProductReject $productReject
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function show(ProductReject $productReject): JsonResponse
	{
		try {
		    //{{CONTROLLER_RELATIONSHIP_MTM_SHOW_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($productReject);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * update once by id
	 * @param StoreProductRejectRequest $request
	 * @param ProductReject $productReject
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function update(StoreProductRejectRequest $request, ProductReject $productReject): JsonResponse
	{
		try {
		    $productReject->fill($request->all());
            $productReject->save();
            //{{CONTROLLER_RELATIONSHIP_MTM_UPDATE_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($productReject);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * delete once by id
	 * @param ProductReject $productReject
	 * @return JsonResponse
	 * @author tanmnt
	 */
    public function destroy(ProductReject $productReject): JsonResponse
    {
	    try {
	        //{{CONTROLLER_RELATIONSHIP_MTM_DELETE_NOT_DELETE_THIS_LINE}}
			$productReject->delete();

		    return $this->jsonMessage(trans('messages.delete'));
	    } catch (\Exception $e) {
	    	return $this->jsonError($e);
	    }
    }

    //{{CONTROLLER_RELATIONSHIP_NOT_DELETE_THIS_LINE}}
}
