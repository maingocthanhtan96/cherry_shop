<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:02:10
 * File: Member.php
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\Member;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreMemberRequest;

class MemberController extends Controller
{
    /**
     * Member constructor.
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

            $queryService = new QueryService(new Member());
            $queryService->select = [];
            $queryService->columnSearch = ['name', 'code', 'phone'];
            $queryService->withRelationship = [];
            $queryService->search = $search;
            $queryService->betweenDate = $betweenDate;
            $queryService->limit = $limit;
            $queryService->ascending = $ascending;
            $queryService->orderBy = $orderBy;

            $query = $queryService->queryTable();
            $query = $query->paginate($limit);
            $member = $query->toArray();

            return $this->jsonTable($member);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * create
     * @param StoreMemberRequest $request
     * @return JsonResponse
     * @author tanmnt
     */
    public function store(StoreMemberRequest $request): JsonResponse
    {
        try {
            $member = new Member();
            $member->fill($request->all());
            $member->save();
            $member->code = Member::PREFIX_CODE . str_pad($member->id, 2, '0', STR_PAD_LEFT);
            $member->save();
            //{{CONTROLLER_RELATIONSHIP_MTM_CREATE_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($member, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * get once by id
     * @param Member $member
     * @return JsonResponse
     * @author tanmnt
     */
    public function show(Member $member): JsonResponse
    {
        try {
            //{{CONTROLLER_RELATIONSHIP_MTM_SHOW_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($member);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * update once by id
     * @param StoreMemberRequest $request
     * @param Member $member
     * @return JsonResponse
     * @author tanmnt
     */
    public function update(StoreMemberRequest $request, Member $member): JsonResponse
    {
        try {
            $member->fill($request->all());
            $member->save();
            //{{CONTROLLER_RELATIONSHIP_MTM_UPDATE_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($member);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * delete once by id
     * @param Member $member
     * @return JsonResponse
     * @author tanmnt
     */
    public function destroy(Member $member): JsonResponse
    {
        try {
            //{{CONTROLLER_RELATIONSHIP_MTM_DELETE_NOT_DELETE_THIS_LINE}}
            $member->delete();

            return $this->jsonMessage(trans('messages.delete'));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * get all data from Member
     * @return JsonResponse
     */
    public function getMember(): JsonResponse
    {
        try {
            $members = Member::all();

            return $this->jsonData($members);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $search = $request->get('search');
            $member = Member::where('name', 'LIKE', "%$search%")
                ->orWhere('code', 'LIKE', $search)
                ->get();

            return $this->jsonData($member);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    //{{CONTROLLER_RELATIONSHIP_NOT_DELETE_THIS_LINE}}
}
