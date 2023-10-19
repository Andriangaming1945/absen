<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->latest()->get();

        return view('user.user-management', [
            'title' => 'User Management',
            'users' => $users,
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_id' => 'required|numeric|unique:users',
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'roles' => 'required',
            'status' => 'required',
            'employment_status' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error', 'There was a problem adding.');
        }

        $validated = $validator->validated();

        $user = User::create([
            'no_id' => $validated['no_id'],
            'name' => $validated['name'],
            'username' => $validated['username'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'password' => Hash::make($validated['password']),
            'employment_status' => $validated['employment_status'],
            'status' => $validated['status'],
        ]);

        $role = Role::findById($validated['roles']);

        $user->assignRole($role);

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
        $user = User::with('roles')->findOrFail($id);

        $rules = [
            'name' => 'required',
            'username' => 'required|numeric',
            'roles' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'status' => 'required',
            'employment_status' => 'required',
        ];

        if($request->username != $user->username){
            $rules['username'] = 'required|unique:users';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return back()->with('error', 'There was a problem adding.');
        }

        $validated = $validator->validated();

        if($request->password){
            $validated['password'] = Hash::make($request->password);
        }

        if($validated['roles'] != $user->roles[0]->id){
            $user->removeRole($user->roles[0]->name);
            $new_role = Role::findById($validated['roles']);
            $user->assignRole($new_role);
        }

        $user->update(collect($validated)->forget("roles")->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return back();
    }
}
