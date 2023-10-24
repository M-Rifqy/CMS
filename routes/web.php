<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
    // Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    
    Route::get('/all/permission', [RoleController::class, 'AllPermission'])->name('all.permission');
    Route::get('/add/permission', [RoleController::class, 'AddPermission'])->name('add.permission');
    Route::post('/store/permission', [RoleController::class, 'StorePermission'])->name('store.permission');
    Route::get('/edit/permission/{id}', [RoleController::class, 'EditPermission'])->name('edit.permission');
    Route::post('/update/permission', [RoleController::class, 'UpdatePermission'])->name('update.permission');
    Route::get('/delete/permission/{id}', [RoleController::class, 'DeletePermission'])->name('delete.permission');
    
    Route::get('/all/role', [RoleController::class, 'AllRole'])->name('all.role');
    Route::get('/add/role', [RoleController::class, 'AddRole'])->name('add.role');
    Route::post('/store/role', [RoleController::class, 'StoreRole'])->name('store.role');
    Route::get('/edit/role/{id}', [RoleController::class, 'EditRole'])->name('edit.role');
    Route::post('/update/role', [RoleController::class, 'UpdateRole'])->name('update.role');
    Route::get('/delete/role/{id}', [RoleController::class, 'DeleteRole'])->name('delete.role');
    
    Route::get('/all/role/permission', [RoleController::class, 'AllRolePermission'])->name('all.role.permission');
    Route::get('/add/role/permission', [RoleController::class, 'AddRolePermission'])->name('add.role.permission');
    Route::post('/role/permission/store', [RoleController::class, 'RolePermissionStore'])->name('role.permission.store');
    Route::get('/edit/role/permission/{id}', [RoleController::class, 'EditRolePermission'])->name('edit.role.permission');
    Route::post('/update/role/permission/{id}', [RoleController::class, 'UpdateRolePermission'])->name('update.role.permission');
});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

require __DIR__ . '/auth.php';
