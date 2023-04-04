<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MempelaiController;

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
    $data = [
        'badge' => 'dashboard',
        'title' => 'Dashboard | Gian Wedding',
    ];
    return view('index',$data);
})->middleware('auth');
Route::get('/home', function () {
    $data = [
        'badge' => 'dashboard',
        'title' => 'Dashboard | Gian Wedding',
    ];
    return view('index',$data);
})->middleware('auth');

// USERS
    // Halaman Utama
Route::resource('/users', UserController::class)->middleware('auth');
    // Datatables
Route::get('/dataTables', [UserController::class, 'dataTables'])->middleware('auth');
// Ambil Data User 
Route::get('/editUser', [UserController::class, 'editUser'])->middleware('auth');

// LOGIN
// login
Route::get('/auth', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/auth', [LoginController::class,'authenticate']);
Route::get('/auth/logout', [LoginController::class,'logout'])->middleware('auth');

// MEMPELAI
Route::resource('/mempelai', MempelaiController::class)->middleware('auth');
    // Datatables
Route::get('/dataTablesMempelai', [MempelaiController::class, 'dataTables'])->middleware('auth');
Route::get('/dataTablesInvited', [MempelaiController::class, 'dataTablesInvited'])->middleware('auth');
    //Create Slug
Route::get('/createSlug', [MempelaiController::class,'cekSlug'])->middleware('auth');
    //Update Data Mempelai
Route::post('/dataMempelai', [MempelaiController::class,'updateDataMempelai'])->middleware('auth');
    //Update Akad Mempelai
Route::post('/akadMempelai', [MempelaiController::class,'updateAkadMempelai'])->middleware('auth');
    //Update Tamu Undangan
Route::post('/inviteMempelai', [MempelaiController::class,'updateInviteMempelai'])->middleware('auth');
    // Ambil Data Tamu Undangan
Route::get('/editInvited', [MempelaiController::class, 'editInvited'])->middleware('auth');
Route::post('/updateInvited', [MempelaiController::class, 'updateInvited'])->middleware('auth');
    // Hapus Tamu Undangan
Route::post('/deleteInvited', [MempelaiController::class, 'destroyInvited'])->middleware('auth');
Route::get('/doneProses', [MempelaiController::class, 'doneProses'])->middleware('auth');
    // Upload Photo
Route::post('/uploadPhoto', [MempelaiController::class, 'uploadPhoto'])->middleware('auth');
Route::get('/deletePhoto', [MempelaiController::class, 'deletePhoto'])->middleware('auth');

// LOAD SEBAGIAN HALAMAN
Route::get('/load-content',[MempelaiController::class, 'reloadGallery'])->middleware('auth');
