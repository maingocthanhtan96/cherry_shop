<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $roles = Role::all();

            return $this->jsonData(RoleResource::collection($roles));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(StoreRoleRequest $request): JsonResponse
    {
        try {
            $role = Role::create($request->all());

            return $this->jsonData(new RoleResource($role));
        } catch (\Exception $e) {
            $this->jsonError($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(Request $request, Role $role): JsonResponse
    {
        try {
            if (!$role || $role->isAdmin()) {
                return $this->jsonMessage('Role not found!', false, 404);
            }
            $viewMenu = Permission::VIEW_MENU;
            $input = $request->all();
            $viewMenuPermissions = [];
            $permissions = $request->get('permissions', []);
            foreach ($permissions['menu'] as $menu) {
                $name = $viewMenu . $menu;
                if ($name !== $viewMenu) {
                    array_push($viewMenuPermissions, $name);
                    Permission::findOrCreate($name, 'api');
                }
            }

            $permissions = Permission::whereIn('id', $permissions['other'])
                ->get(['name'])
                ->toArray();
            $permissions = array_merge($viewMenuPermissions, $permissions);
            $role->syncPermissions($permissions);
            $role->update([
                'name' => $input['role']['name'],
                'description' => $input['role']['description'],
            ]);

            return $this->jsonData(new RoleResource($role));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        try {
            if (!$role || $role->isAdmin()) {
                return $this->jsonMessage('Role not found!', false, 404);
            }
            $role->delete();

            return $this->jsonMessage(trans('messages.delete'));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
