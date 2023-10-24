<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Contracts\Permission as ContractsPermission;

class RoleController extends Controller
{
    public function AllPermission()
    {
        $permissions = Permission::all();
        return view('permission.all_permission', compact('permissions'));
    }

    public function AddPermission()
    {
        return view('permission.add_permission');
    }

    public function StorePermission(Request $request)
    {
        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Created Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permission.edit_permission', compact('permission'));
    }

    public function UpdatePermission(Request $request)
    {
        $per_id = $request->id;

        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id)
    {
        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function AllRole()
    {
        $roles = Role::all();
        return view('role.all_role', compact('roles'));
    }

    public function AddRole()
    {
        return view('role.add_role');
    }

    public function StoreRole(Request $request)
    {
        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Created Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.role')->with($notification);
    }

    public function EditRole($id)
    {
        $roles = Role::findOrFail($id);
        return view('role.edit_role', compact('roles'));
    }

    public function UpdateRole(Request $request)
    {
        $role_id = $request->id;
        Role::findOrFail($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.role')->with($notification);
    }

    public function DeleteRole($id)
    {
        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function AddRolePermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('rolesetup.add_role_permission', compact('roles', 'permissions', 'permission_groups'));
    }

    public function RolePermissionStore(Request $request)
    {
        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.role.permission')->with($notification);
    }

    public function AllRolePermission()
    {
        $roles = Role::all();
        return view('rolesetup.all_role_permission', compact('roles'));
    }
}
