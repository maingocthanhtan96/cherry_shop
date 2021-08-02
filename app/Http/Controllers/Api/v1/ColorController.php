<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:55:13
 * File: Color.php
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\Color;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreColorRequest;

class ColorController extends Controller
{
    /**
     * Color constructor.
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

			$queryService = new QueryService(new Color);
            $queryService->select = [];
            $queryService->columnSearch = [];
            $queryService->withRelationship = ['products'];
            $queryService->search = $search;
            $queryService->betweenDate = $betweenDate;
            $queryService->limit = $limit;
            $queryService->ascending = $ascending;
            $queryService->orderBy = $orderBy;

            $query = $queryService->queryTable();
            $query = $query->paginate($limit);
            $color = $query->toArray();

			return $this->jsonTable($color);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * create
	 * @param StoreColorRequest $request
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function store(StoreColorRequest $request): JsonResponse
	{
		try {
		    $color = new Color();
		    $color->fill($request->all());
            $color->save();
			$productId = $request->get('product_id', []);
            if($productId) {
                $color->products()->attach($productId);
            }
            //{{CONTROLLER_RELATIONSHIP_MTM_CREATE_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($color, Response::HTTP_CREATED);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * get once by id
	 * @param Color $color
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function show(Color $color): JsonResponse
	{
		try {
		    $color->product_id = \Arr::pluck($color->products()->get(), 'pivot.product_id');
            //{{CONTROLLER_RELATIONSHIP_MTM_SHOW_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($color);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * update once by id
	 * @param StoreColorRequest $request
	 * @param Color $color
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function update(StoreColorRequest $request, Color $color): JsonResponse
	{
		try {
		    $color->fill($request->all());
            $color->save();
            $productId = $request->get('product_id', []);
            if($productId) {
                $color->products()->sync($productId);
            }
            //{{CONTROLLER_RELATIONSHIP_MTM_UPDATE_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($color);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * delete once by id
	 * @param Color $color
	 * @return JsonResponse
	 * @author tanmnt
	 */
    public function destroy(Color $color): JsonResponse
    {
	    try {
	        $color->products()->detach();
            //{{CONTROLLER_RELATIONSHIP_MTM_DELETE_NOT_DELETE_THIS_LINE}}
			$color->delete();

		    return $this->jsonMessage(trans('messages.delete'));
	    } catch (\Exception $e) {
	    	return $this->jsonError($e);
	    }
    }

    /**
     * get all data from Color
     * @return JsonResponse
     */
    public function getColor(): JsonResponse
    {
        try {
            $colors = Color::all();

            return $this->jsonData($colors);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    //{{CONTROLLER_RELATIONSHIP_NOT_DELETE_THIS_LINE}}
}
