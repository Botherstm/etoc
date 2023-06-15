<?php

use App\Http\Controllers\AccController;
use App\Http\Controllers\ActiveUasController;
use App\Http\Controllers\ActiveUtsController;
use App\Http\Controllers\BuatsoalController;
use App\Http\Controllers\BuatsoaluasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\LamaUasController;
use App\Http\Controllers\LamaUjianTengahSemesterController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\PostmateriController;
use App\Http\Controllers\StartUasController;
use App\Http\Controllers\StartUtsController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\TugasjawabController;
use App\Http\Controllers\UasController;
use App\Http\Controllers\UasjawabController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtsController;
use App\Http\Controllers\UtsjawabController;
use App\Models\Start_uts;

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

Route::get('/',[PostinganController::class,'index',])->middleware(['auth']);
// Route::get('/materi',[PostController::class,'index',])->middleware(['auth', 'verified'])->name('post.index');
Route::get('/daftar/materi', [PostmateriController::class,'index',])->middleware(['auth']);;
Route::get('/posts/{materi_id}', [PostController::class, 'index'])->middleware(['auth']);
// Route::get('/layouts/post/{post:id}',[PostController::class,'show',])
//     ->middleware('check.post.progress')
//     ->name('materi.show');
Route::resource('/dashboard/tugas', TugasController::class)->middleware(['auth']);
Route::resource('/dashboard/tugasjawab', TugasjawabController::class)->middleware(['auth']);
// routes/web.php
Route::post('/dashboard/tugas', [TugasController::class, 'store'])->name('tugas.store')->middleware(['auth']);

Route::post('/tasks/store', [TugasjawabController::class, 'store'])->name('tasks.store')->middleware(['auth']);
Route::get('/tugas/{tugas}/toggle-gambar', [TugasController::class, 'toggleGambar'])->name('tugas.toggle-gambar')->middleware(['auth']);
Route::get('/tugas/{tugas}/toggle-video', [TugasController::class, 'toggleVideo'])->name('tugas.toggle-video')->middleware(['auth']);
Route::get('/tugas/{tugas}/toggle-pdf', [TugasController::class, 'togglePDF'])->name('tugas.toggle-pdf')->middleware(['auth']);
Route::get('/tugas/{tugas}/toggle-text', [TugasController::class, 'toggleText'])->name('tugas.toggle-text')->middleware(['auth']);

Route::get('/materi/{id}', [PostController::class,'show',])
    ->middleware('auth', 'check.post.progress')
    ->name('materi.show')->middleware(['auth']);
Route::get('/materi/{id}/update-progress', [PostController::class,'updateProgress',])->name('materi.updateProgress')->middleware('auth');
Route::post('/judul/materi', [MateriController::class,'store',])->middleware('admin');
// Route::put('/judul/materi/{id}', [MateriController::class, 'update'])->name('judul.materi.update')->middleware(['auth']);
// Route::delete('/judul/materi', [MateriController::class, 'destroy'])->name('judul.materi.destroy')->middleware(['auth']);
// Route::resource('/judul/materi',PostinganController::class);
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::resource('/dasboard/materi',MateriController::class);
// Route::get('/', function(){return view ('baru.index');});
//  Route::get('/profile', function(){return view ('profile.edit');});
Route::get('/layouts/post/{post:id}', [PostController::class,'show'])->middleware(['auth']);
Route::post('/layouts/post/acces/{post:id}', [PostController::class,'accessPost'])->middleware(['auth']);

Route::get('/login', [LoginController::class,'index',])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class,'authenticate',]);

Route::post('/logout', [LoginController::class,'logout',]);

Route::get('/register', [RegisterController::class,'index',])->middleware('guest');

Route::post('/register', [RegisterController::class,'store',]);

Auth::routes(['verify'=>true]);

Route::get('/dashboards', function(){return view ('dashboard.index');})->middleware('admin')->name('dashboards');
// Route::post('/active/uts',[ActiveUtsController::class,'update']);
Route::post('/update-first-active', [ActiveUtsController::class, 'updateFirstActive'])->name('update-first-active');
Route::post('/uas-first-active', [ActiveUasController::class, 'updateuasFirstActive'])->name('uas-first-active');
Route::post('/uts/selesai', [UtsController::class,'selesai',])->middleware('auth');



Route::resource('/dashboard/post',DashboardPostController::class)->middleware('admin');
Route::resource('/uts/mulai',StartUtsController::class )->middleware(['auth']);
Route::resource('/uas/mulai',StartUasController::class )->middleware(['auth']);
Route::resource('/uts',UtsController::class )->middleware(['auth']);
Route::resource('/uas',UasController::class )->middleware(['auth']);
Route::resource('/dashboard/uts',BuatsoalController::class );
Route::resource('/dashboard/uas',BuatsoaluasController::class );
Route::delete('/dashboard/mahasiswa/delete/all', [AccController::class, 'deleteAllExceptAdmin'])->name('users.deleteAllExceptAdmin');
Route::resource('/dashboard/mahasiswa',AccController::class);
Route::resource('/nilai',UtsjawabController::class );
Route::resource('/nilaiuas',UasjawabController::class);
Route::post('/uts/jawab',[UtsjawabController::class ,'store'])->name('/uts/jawab');
Route::post('/uas/jawab',[UasjawabController::class,'store'])->name('/uas/jawab');
Route::resource('/uts/lamauts',LamaUjianTengahSemesterController::class );
Route::resource('/uas/lamauas',LamaUasController::class );
Route::resource('/user/gambar',UserController::class)->middleware('auth');
// Route::post('/uts/lamauts', 'LamaUjianTengahSemesterController@update')->name('time.update');

// Route::post('/uts/start', [UtsController::class, 'start'])->name('exam-midterms.start');
// Route::post('/uts/submit', [UtsController::class, 'store'])->name('exam-midterms.submit');
Route::get('/exam/midterms/complete', 'UtsController@complete')->name('exam-midterms.complete');
Route::get('/exam-midterms', 'UtsController@index')->name('exam-midterms.index');
Route::post('/exam-midterms/submit', 'UtsController@submit')->name('exam-midterms.submit');
Route::get('/user/{id}/remove-field', [UserController::class, 'removeField'])->name('user.removeField');
Route::get('/user/{id}/remove-uts-complete-at', [UserController::class, 'removeUtsCompleteAt'])->name('user.removeUtsCompleteAt');


Route::get('/dashboard', function () {
    return view('profile.main');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

