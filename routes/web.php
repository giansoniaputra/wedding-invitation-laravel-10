<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KadoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\StoryController;
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
    return view('index', $data);
})->middleware('auth');
Route::get('/home', function () {
    $data = [
        'badge' => 'dashboard',
        'title' => 'Dashboard | Gian Wedding',
    ];
    return view('index', $data);
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
Route::get('/auth', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/auth', [LoginController::class, 'authenticate']);
Route::get('/auth/logout', [LoginController::class, 'logout'])->middleware('auth');

// MEMPELAI
Route::resource('/mempelai', MempelaiController::class)->middleware('auth');
// Datatables
Route::get('/dataTablesMempelai', [MempelaiController::class, 'dataTables'])->middleware('auth');
Route::get('/dataTablesInvited', [MempelaiController::class, 'dataTablesInvited'])->middleware('auth');
Route::get('/dataTablesStory', [StoryController::class, 'dataTables'])->middleware('auth');
Route::get('/dataTablesPayment', [KadoController::class, 'dataTables'])->middleware('auth');
//Create Slug
Route::get('/createSlug', [MempelaiController::class, 'cekSlug'])->middleware('auth');
//Update Data Mempelai
Route::post('/dataMempelai', [MempelaiController::class, 'updateDataMempelai'])->middleware('auth');
Route::post('/akadMempelai', [MempelaiController::class, 'updateAkadMempelai'])->middleware('auth');
//Update Tamu Undangan
Route::post('/inviteMempelai', [MempelaiController::class, 'updateInviteMempelai'])->middleware('auth');
// Ambil Data Tamu Undangan
Route::get('/editInvited', [MempelaiController::class, 'editInvited'])->middleware('auth');
Route::post('/updateInvited', [MempelaiController::class, 'updateInvited'])->middleware('auth');
// Hapus Tamu Undangan
Route::post('/deleteInvited', [MempelaiController::class, 'destroyInvited'])->middleware('auth');
Route::get('/doneProses', [MempelaiController::class, 'doneProses'])->middleware('auth');
// Upload Photo
Route::post('/uploadPhoto', [MempelaiController::class, 'uploadPhoto'])->middleware('auth');
Route::post('/kirimUcapan', [MempelaiController::class, 'kirimUcapan']);
Route::get('/deletePhoto', [MempelaiController::class, 'deletePhoto'])->middleware('auth');
// LOAD SEBAGIAN HALAMAN
Route::get('/load-content', [MempelaiController::class, 'reloadGallery'])->middleware('auth');
Route::get('/load-ucapan', [MempelaiController::class, 'reloadUcapan']);
// AKTIVASI
Route::post('/activasi', [MempelaiController::class, 'activasiUndangan'])->middleware('auth');
// PHOTO
//Mempelai
Route::get('/editPhotoMempelai/{slug}', [PhotoController::class, 'edit_photo_mempelai'])->middleware('auth');
Route::get('/editPhotoMempelai/upload-photo-mempelai', [PhotoController::class, 'upload-photo-mempelai'])->middleware('auth');
Route::post('/updatePhoto', [PhotoController::class, 'update_photo'])->middleware('auth');
//Gallery
Route::get('/gallery/{slug}', [PhotoController::class, 'page_gallery'])->middleware('auth');
Route::post('/upload-gallery/{slug}', [PhotoController::class, 'page_upload'])->middleware('auth');
Route::post('/delete-photo/{slug}', [PhotoController::class, 'delete_photo'])->middleware('auth');
//Cover
Route::get('/cover/{slug}', [PhotoController::class, 'page_cover'])->middleware('auth');
Route::post('/updateCover', [PhotoController::class, 'update_cover'])->middleware('auth');

// STORY-------------------------------------------------------------------------------
Route::resource('/mempelai/{mempelai:slug}/story', StoryController::class)->middleware('auth');
Route::get('/status/story-aktif/{mempelai:slug}', [StoryController::class, 'aktif'])->middleware('auth');
Route::get('/getIdStory/{story:id}', [StoryController::class, 'getIdStory'])->middleware('auth');
Route::post('/updateStory', [StoryController::class, 'update_2'])->middleware('auth');
Route::post('/deleteStory', [StoryController::class, 'delete'])->middleware('auth');
//GIFT
Route::resource('/mempelai/{mempelai:slug}/kado', KadoController::class)->middleware('auth');
Route::post('/addPayment', [KadoController::class, 'add_payment'])->middleware('auth');
Route::get('/getDataPayment', [KadoController::class, 'get_payment'])->middleware('auth');
Route::post('/updateDataPayment', [KadoController::class, 'update_payment'])->middleware('auth');
Route::post('/deleteDataPayment', [KadoController::class, 'delete_payment'])->middleware('auth');

// Baru
Route::get('/brown', function () {
    return view('front-end.brown');
});

// MENAMPILKAN FRONT END (harus paling bawah)
Route::get('/{mempelai:slug}', [MempelaiController::class, 'front_end']);
Route::get('/{mempelai:slug}/{anything}', [MempelaiController::class, 'name']);
