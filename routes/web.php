<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleUsersController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PermissionRolesController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboards/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get("/dashboards",[DashboardsController::class,'index'])->name("dashboard.index");

    Route::resource('users', UsersController::class);
    Route::resource("roles",RolesController::class);

    Route::resource("permissions",PermissionsController::class);
    Route::get("/permissionsstatus",[PermissionsController::class,"typestatus"]);
    Route::delete("/permissionsbulkdeletes",[PermissionsController::class,"bulkdeletes"])->name("permissions.bulkdeletes");

    Route::resource("permissionroles",PermissionRolesController::class);
    Route::delete("/permissionrolesbulkdeletes",[PermissionRolesController::class,"bulkdeletes"])->name("permissionroles.bulkdeletes");

    Route::resource("roleusers",RoleUsersController::class);
    Route::delete("/roleusersbulkdeletes",[RoleUsersController::class,"bulkdeletes"])->name("roleusers.bulkdeletes");

});



require __DIR__.'/auth.php';
