<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        /**
         * @var App\Model\User $authUser
         */
        $authUser = auth()->user();
        if ($authUser->hasRole('admin')) {
            $users = User::with('roles')->whereKeyNot(1)->get();
        } else {
            $users = User::with('roles')->where('current_team_id', '=', auth()->user()->current_team_id)->where('current_team_id', '<>', null)->get();
        }
        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $groupPermissions = Permission::where([
            ['is_default', 0],
            ['is_allow', 1]
        ])->orderBy('name', 'ASC')->get()->groupBy('uses');
        return view('users.create', [
            'roles' => Role::where('name', '<>', 'admin')->get(),
            'grouppermissions' => $groupPermissions,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'unique:users,username'],
            'password' => ['required'],
            'role' => ['required'],
            'language' => ['required'],
            'store_id' => ['nullable', 'unique:users,store_id'],
        ]);
        DB::transaction(function () use ($request) {
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->lang = $request->language;
            $user->password = bcrypt($request->password);
            $user->status = 0;
            if ($request->has('active')) {
                $user->status = 1;
            }
            $user->contact = $request->contact;
            $user->store_id = $request->store_id;
            $user->store_name = $request->store_name;
            $user->store_address = $request->store_address;
            if ($request->hasfile('store_barcode')) {
                $imag = $request->file('store_barcode');
                $ext = $imag->extension();
                $imag_name = 'store-barcode-' . $request->store_id . time() . '.' . $ext;
                $imag->storeAs('public/img', $imag_name);
                $user->store_barcode = $imag_name;
            }
            $user->save();
            $user->assignRole($request->role);
            $user->syncPermissions($request->permissions);
        });
        return redirect()->route('users.index')->withSuccess(__('User Created'));
    }


    public function edit(User $user)
    {
        $groupPermissions = Permission::where([
            ['is_default', 0],
            ['is_allow', 1]
        ])->orderBy('name', 'ASC')->get()->groupBy('uses');
        return view('users.edit', [
            'user' => $user,
            'userRoles' => $user->roles->pluck('name')->toArray(),
            'userPermissions' => $user->getDirectPermissions()->pluck('name')->toArray(),
            'roles' => Role::where('name', '<>', 'admin')->get(),
            'groupPermissions' => $groupPermissions,
        ]);
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'unique:users,username,' . $user->id],
            'role' => ['required'],
            'language' => ['required'],
            'store_id' => ['nullable', 'unique:users,store_id,' . $user->id],
        ]);
        DB::transaction(function () use ($request, $user) {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->lang = $request->language;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->status = 0;

            if ($request->has('active')) {
                $user->status = 1;
            }
            $user->contact = $request->contact;
            $user->store_id = $request->store_id;
            $user->store_name = $request->store_name;
            $user->store_address = $request->store_address;
            if ($request->hasfile('store_barcode')) {
                $imag = $request->file('store_barcode');
                $ext = $imag->extension();
                $imag_name = 'store-barcode-' . $request->store_id . time() . '.' . $ext;
                $imag->storeAs('public/img', $imag_name);
                $user->store_barcode = $imag_name;
            }
            $user->save();
            $user->syncRoles($request->role);
            $user->syncPermissions($request->permission);
        });

        $user->save();
        return redirect()->route('users.index')->withSuccess(__('User Updated Successfully'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->withSuccess('User Deleted Successfully');
    }
}
