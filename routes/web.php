<?php

use App\Http\Controllers\Assets\AssetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesAndPermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('tela-usuario','users.index')->middleware('permission:Add User');
    Route::view('tela-produto','products.index')->middleware('permission:Add Product');
    Route::view('tela-notificacoes','notifications.index'); // ->middleware('permission:Add Product');
});

Route::get('add-permission',[RolesAndPermissionController::class, 'addPermission'])->name('add-permission');
Route::get('add-permissions',[RolesAndPermissionController::class, 'addPermissions'])->name('add-permissions');

/** ROLES & PERMISSIONS */
Route::get('show-roles-permissions',[RolesAndPermissionController::class, 'showRolesPermissions'])->name('show-roles-permissions');
Route::post('create-role',[RolesAndPermissionController::class, 'createRole'])->name('create-role');

//Route::get('test',[RolesAndPermissionController::class, 'test'])->name('test');

// Example adding Permission to a view using the Route
Route::view('push-notification','PushNotification.Index')->middleware('permission:Push Notification');


require __DIR__.'/auth.php';

// Routes for Working Templates - Only Views
Route::view('gestao','management.index')->middleware('permission:management');
Route::view('relatorios','reports.index')->middleware('permission:reports');
//Route::view('ativos','assets.index')->middleware('permission:assets');
Route::get('ativos',[AssetController::class, 'index'])->name('ativos');
Route::get('ativos/destroy/{id}',[AssetController::class, 'destroy'])->name('ativos_destroy');
Route::post('ativos/store',[AssetController::class, 'store'])->name('ativos_store');
Route::view('equipe','teams.index')->middleware('permission:teams');;
Route::view('compras','transactions.index')->middleware('permission:transactions');
//Route::view('sistema-administrativo','admin.dashboard');
//Route::view('dashboard','welcome');

//Route::view('test','frontend.index');
Route::get('student',[\App\Http\Controllers\StudentController::class, 'index'])->name('student');
