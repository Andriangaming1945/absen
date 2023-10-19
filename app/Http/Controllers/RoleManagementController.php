<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->latest()->get();
        $permissions = Permission::with('roles')->oldest()->get();

        return view('role.role-management', [
            'title' => 'Role Management',
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation =  Validator::make($request->all(), [
            'name' => 'required',
            'permissions' => 'required|array'
        ]);

        if($validation->fails()){
            return back()->with('error', 'There was a problem adding.');
        }

        $validate = $validation->validated();

        $role = Role::create(['name' => $validate['name']]);

        foreach($validate['permissions'] as $permission){
            $pm = Permission::findById($permission);
            $role->givePermissionTo($pm);
        }

        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation =  Validator::make($request->all(), [
            'name' => 'required',
            'permissions' => 'required|array'
        ]);

        if($validation->fails()){
            return back()->with('error', 'There was a problem making the change.');
        }

        $validate = $validation->validated();

        $data = Role::with('permissions')->findOrFail($id);

        $permissions = [];
        $dataAllPermissions = [];

        foreach($data->permissions as $permission){
            $permissions[] = $permission->id;
        }

        $data_permissions = Permission::oldest()->get();
        foreach($data_permissions as $data){
            $dataAllPermissions[] = $data->id;
        }

        $role = Role::findById($id);

        foreach($validate['permissions'] as $per){
            if(!in_array($per, $permissions)){
                $p = Permission::findById($per);

                $role->givePermissionTo($p);
            }
        }

        foreach($permissions as $permission){
            if(!in_array($permission, $validate['permissions'])){
                $p = Permission::findById($permission);

                $role->revokePermissionTo($p);
            }
        }


        $new_role = Role::where('id', $id)->first();
        $new_role->update(['name' => $validate['name']]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Role::with('permissions')->findOrFail($id);

        $data->delete();

        return back();
    }
}
