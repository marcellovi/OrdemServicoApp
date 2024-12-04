<?php

use App\Http\Controllers\ArtefatoController;
use App\Http\Controllers\Ativos\AtivoController;
use App\Http\Controllers\Ativos\ItemController;
use App\Http\Controllers\OrdemServico\OrdemServicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesAndPermissionController;
use App\Http\Controllers\Usuarios\CargoController;
use App\Http\Controllers\Usuarios\UserController;
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

    Route::view('tela-usuario','users.index')->middleware('permission:dashboard');
    Route::view('tela-produto','products.index')->middleware('permission:dashboard');
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
Route::view('relatorios','relatorios.index')->middleware('permission:reports')->name('relatorios');
//Route::view('ativos','assets.index')->middleware('permission:assets');

// USUARIOS & EQUIPE & PERMISSAO
Route::get('usuarios',[UserController::class, 'index'])->name('usuarios');
Route::get('usuarios/destroy/{id}',[UserController::class, 'destroy'])->name('usuarios.destroy');
Route::post('usuarios/store',[UserController::class, 'store'])->name('usuarios.store');
Route::get('usuarios/{id}/edit', [UserController::class,'edit'])->name('usuarios.edit');
Route::put('usuarios/{id}', [UserController::class ,'update'])->name('usuarios.update');

// PERFIL
Route::get('perfil/{id}', [UserController::class ,'indexPerfil'])->name('perfil.index');
Route::put('perfil/update/{id}', [UserController::class ,'updatePerfil'])->name('perfil.update');
Route::put('perfil/avatar/update', [UserController::class ,'updateAvatar'])->name('avatar.update');


// ATIVOS
Route::get('painel-ativos',[AtivoController::class, 'painel'])->name('painel-ativos');
Route::get('ativos',[AtivoController::class, 'index'])->name('ativos');
Route::get('ativos/destroy/{id}',[AtivoController::class, 'destroy'])->name('ativos.destroy');
Route::post('ativos/store',[AtivoController::class, 'store'])->name('ativos_store');
Route::get('ativos/{id}/edit', [AtivoController::class,'edit'])->name('ativos.edit');
Route::put('ativos/{ativos}', [AtivoController::class ,'update'])->name('ativos.update');

// ATIVOS & ITENS
Route::get('ativos-itens',[AtivoController::class, 'ativosItens'])->name('ativos-itens');
Route::post('ativos-itens/store',[AtivoController::class, 'store'])->name('ativos_store');
Route::post('ativos-itens/items-store',[AtivoController::class, 'storeItem'])->name('items.store');
Route::post('link-ativos-itens/store',[AtivoController::class, 'linkStoreAtivoItems'])->name('link.ativos.itens.store');
Route::get('link-ativos-itens',[AtivoController::class, 'linkAtivosItens'])->name('link-ativos-itens');

// ORDEM SERVICO
Route::get('gestao',[OrdemServicoController::class, 'index'])->name('gestao');
Route::get('gestao/destroy/{id}',[OrdemServicoController::class, 'destroy'])->name('gestao.destroy');
Route::post('gestao/store',[OrdemServicoController::class, 'store'])->name('gestao_store');
Route::get('gestao/{id}/edit', [OrdemServicoController::class,'edit'])->name('gestao.edit');
Route::put('gestao/{id}', [OrdemServicoController::class ,'update'])->name('gestao.update');

// CHAMADOS
Route::get('gestao/chamado',[OrdemServicoController::class, 'chamado'])->name('chamado.index');
Route::post('gestao/chamado/store',[OrdemServicoController::class, 'chamadoStore'])->name('chamado.store');
Route::get('gestao/chamado/{id}/edit', [OrdemServicoController::class,'chamadoEdit'])->name('chamado.edit');
Route::get('gestao/chamado/destroy/{id}',[OrdemServicoController::class, 'chamadoDestroy'])->name('chamado.destroy');
Route::put('gestao/chamado/{id}', [OrdemServicoController::class ,'chamadoUpdate'])->name('chamado.update');


// CARGO
Route::post('cargo/store',[CargoController::class, 'store'])->name('cargo.store');


Route::view('equipe','equipes.index')->middleware('permission:teams')->name('equipe');
Route::view('compras','transacoes.index')->middleware('permission:transactions')->name('compras');
//Route::view('sistema-administrativo','admin.dashboard');
//Route::view('dashboard','welcome');

// IMPORTAR ARQUIVOS
Route::post('importar/csv/itens',[ItemController::class, 'importarItensCSV'])->name('importar.csv.itens');
Route::post('importar/csv/ativosmodelo',[ItemController::class, 'importarAtivosModelCSV'])->name('importar.csv.ativosmodelo');
