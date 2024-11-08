<?php

use App\Http\Controllers\ArtefatoController;
use App\Http\Controllers\Assets\AssetController;
use App\Http\Controllers\Management\OrderServicoController;
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
//Route::view('gestao','management.index')->middleware('permission:management');
Route::view('relatorios','reports.index')->middleware('permission:reports')->name('relatorios');
//Route::view('ativos','assets.index')->middleware('permission:assets');

// ARTEFATOS - supply the ativos
Route::get('artefatos',[ArtefatoController::class, 'index'])->name('artefatos');
Route::get('artefatos/destroy/{id}',[ArtefatoController::class, 'destroy'])->name('artefatos_destroy');
Route::post('artefatos/store',[ArtefatoController::class, 'store'])->name('artefatos_store');
Route::get('artefatos/{id}/edit', [ArtefatoController::class,'edit'])->name('artefatos.edit');
Route::put('artefatos/{artefato}', [ArtefatoController::class ,'update'])->name('artefatos.update');



// ATIVOS
Route::get('ativos',[AssetController::class, 'index'])->name('ativos');
Route::get('ativos/destroy/{id}',[AssetController::class, 'destroy'])->name('ativos_destroy');
Route::post('ativos/store',[AssetController::class, 'store'])->name('ativos_store');
Route::get('ativos/{id}/edit', [AssetController::class,'edit'])->name('ativos.edit');
Route::put('ativos/{ativos}', [AssetController::class ,'update'])->name('ativos.update');

// ORDER SERVICO
Route::get('gestao',[OrderServicoController::class, 'index'])->name('gestao');
Route::get('gestao/destroy/{id}',[OrderServicoController::class, 'destroy'])->name('gestao_destroy');
Route::post('gestao/store',[OrderServicoController::class, 'store'])->name('gestao_store');



Route::view('equipe','teams.index')->middleware('permission:teams')->name('equipe');
Route::view('compras','transactions.index')->middleware('permission:transactions')->name('compras');
//Route::view('sistema-administrativo','admin.dashboard');
//Route::view('dashboard','welcome');

