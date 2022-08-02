<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('roles.index', [
            'roles' => Role::where('name', '<>', 'admin')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groupPermissions = Permission::where([
            ['is_default', 0],
            ['is_allow', 1]
        ])->orderBy('name', 'ASC')->get()->groupBy('uses');
        return view('roles.create', [
            'groupPermissions' => $groupPermissions,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:roles,name'],
            'permission' => ['required'],
        ]);
        $defaultPermissions = Permission::where(['is_default' => 1])->pluck('name', 'name')->toArray();
        $assignedPermissions = array_merge($defaultPermissions, $request->permission);

        $role = Role::create([
            'name' => $request->name,
        ]);
        $role->syncPermissions($assignedPermissions);
        return redirect()->route('roles.index')
            ->withSuccess(__('Role created successfully'));
    }


    public function show(Role $role)
    {
        return view('roles.show', [
            'role' => $role,
            'groupPermissions' => $role->permissions->groupBy('uses'),
        ]);
    }

    public function edit(Role $role)
    {
        $groupPermissions = Permission::where([
            ['is_default', 0],
            ['is_allow', 1]
        ])->orderBy('name', 'ASC')->get()->groupBy('uses');
        return view('roles.edit', [
            'role' => $role,
            'groupPermissions' => $groupPermissions,
            'rolePermissions' => $role->permissions->pluck('name')->toArray(),
        ]);
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'unique:roles,name,' . $role->id],
            'permission' => ['required'],
        ]);
        $role->name = $request->name;
        $role->save();
        $defaultPermissions = Permission::where(['is_default' => 1])->pluck('name', 'name')->toArray();
        $assignedPermissions = array_merge($defaultPermissions, $request->permission);
        $role->syncPermissions($assignedPermissions);
        return redirect()->route('roles.index')
            ->withSuccess(__('Role Updated successfully'));
    }


    public function destroy($id)
    {
        //
    }
}
