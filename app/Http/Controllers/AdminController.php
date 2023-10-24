<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index ');
    }

    // public function AdminLogout(Request $request): RedirectResponse
    // {
    //     Auth::guard('web')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/login');
    // }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile', compact('profileData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }

    public function AdminUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error',
            );
            return back()->with($notification);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully!',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }

    public function AllAdmin()
    {
        $alladmin = User::where('role', 'admin')->get();
        return view('user.all_admin', compact('alladmin'));
    }

    public function AddAdmin()
    {
        $roles = Role::all();
        return view('user.add_admin', compact('roles'));
    }

    public function StoreAdmin(Request $request)
    {
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            $notification = array(
                'message' => 'Email address is already in use!',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'New User Inserted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.admin')->with($notification);
    }

    public function EditAdmin($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.edit_admin', compact('user', 'roles'));
    }

    public function UpdateAdmin(Request $request, $id)
    {

        $existingUser = User::where('email', $request->email)->where('id', '!=', $id)->first();

        if ($existingUser) {
            $notification = array(
                'message' => 'Email address is already in use!',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'User Updated Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.admin')->with($notification);
    }
}
