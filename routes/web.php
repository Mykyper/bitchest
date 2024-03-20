<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use  App\Http\Controllers\UserController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\AuthController;
use wApp\Http\Middleware;
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
// Route::post('/connexion-admin', [AdminController::class, 'traiterConnexion'])->name('connexion.admin');
Route::post('/connexion', [AuthController::class, 'connexion'])->name('connexion');
// Route::get('/login', function () {
//     return view('connection');
// });
Route::get('/', function () {
    return view('connection');
});
Route::middleware(['admin.auth'])->group(function () {
  

Route::get('/app', function () {
    return view('app');
});



Route::get('/update.admin', function () {
    return view('modify');
});
Route::get('/list.users', function () {
    return view('users');
})->name('list_users');

Route::get('/update.user', function () {
    return view('modify_user');
});
Route::get('/delete', function () {
    return view('delete');
});
Route::get('/create', function () {
    return view('create');
});
Route::get('/crypto.list', function () {
    return view('crypto_list')->name('crypto.admin');
});
Route::post('/modifier-admin', [AdminController::class, 'modifierAdmin'])->name('modifier.admin');

Route::post('/users/create', [UserController::class, 'create'])->name('users.create');

Route::get('/list.users', [UserController::class, 'listUsers'])->name('list_users');

Route::get('/update/{id}', [UserController::class, 'showUpdateForm'])->name('update_user_form');

Route::post('/update/{id}', [UserController::class, 'update'])->name('update_user');

Route::get('/delete/{userId}', [UserController::class, 'showDeleteConfirmation'])->name('show_delete_confirmation');


Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('delete_user');
Route::get('/cryptos', [CryptoController::class, 'listCrypto'])->name('cryptos.show'); 
Route::get('/admin/logout', [AdminController::class,'logout'])->name('admin.logout');
 // Vos routes protégées par le middleware admin.auth
});



Route::get('/crypto.user', [CryptoController::class, 'listCrypto2'])->name('cryptos.user');



Route::get('/user.home', function () {
    return view('user_home');
})->name('user_home');
Route::get('/user.side', function () {
    return view('user_sidebar');
});

Route::get('/user.login', function () {
    return view('user_login');
});
Route::post('/connexion-user', [UserController::class, 'traiterConnexion'])->name('connexion.user');
Route::get('/Wallet', function () {
    return view('wallet')->name('wall');
});
Route::get('/edit-user', function () {
    return view('modify_user2');
});
Route::get('/user/edit', [UserController::class, 'edit'])->name('edit_user');

// Route pour traiter la modification de l'utilisateur
Route::post('/user/update/{id}', [UserController::class, 'ModifierUser'])->name('update.user');

Route::get('/user/wallet', [UserController::class, 'index'])->name('user_wallet');
// routes/web.php
Route::post('/approvisionner', [UserController::class,'approvisionner'])->name('approvisionner');

Route::get('/achat', [AchatController::class, 'create'])->name('achat.create');

Route::post('/achat', [AchatController::class, 'store'])->name('achat.store');

Route::get('/user.buy', function () {
    return view('achat')->name('buy');
});
// routes/web.php
// routes/web.php

Route::post('/vendre-crypto', [VenteController::class,'vendreCrypto'])->name('vendre-crypto');

Route::get('/vente-formulaire', [VenteController::class,'showForm'])->name('vente-formulaire');

Route::get('/user.sell', function () {
    return view('ventes')->name('sell');
});





