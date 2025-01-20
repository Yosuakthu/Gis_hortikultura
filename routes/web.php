<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\AdminController;
// Route::middleware(['auth', 'checkLevel:1'])->group(function () {
// });
Route::get('/admin', [AdminController::class, 'index'])->name('dashboard-admin');



use App\Http\Controllers\UsrController;
Route::get('/', [UsrController::class, 'index'])->name('home');
Route::get('/admin/data', [UsrController::class, 'pengguna'])->name("pengguna");
Route::delete('/pengguna/{id}', [UsrController::class, 'destroy'])->name('pengguna.destroy');
Route::get('/pengguna/{id}/edit', [UsrController::class, 'edit'])->name('pengguna.edit');
Route::put('/pengguna/{id}', [UsrController::class, 'update'])->name('pengguna.update');
Route::get('/pengguna/create', [UsrController::class, 'create'])->name('pengguna.create');
Route::post('/pengguna', [UsrController::class, 'store'])->name('pengguna.store');
Route::get('/admin/login', [UsrController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [UsrController::class, 'login'])->name('logproses');
Route::post('/admin/logout', [UsrController::class, 'logout'])->name('keluar');





use App\Http\Controllers\PetaController;
Route::get('/admin/peta', [PetaController::class, 'peta'])->name('adpeta')->middleware('auth', 'checkLevel:1');
Route::get('/peta', [PetaController::class, 'usrpeta'])->name('usrpeta');
Route::get('/admin/import-csv', [PetaController::class, 'showForm'])->name('import-csv.form');
Route::get('admin/show-csv', [PetaController::class, 'showCsvTable'])->name('csv.table');
Route::delete('/showCsvTable/{id}', [PetaController::class, 'destroy'])->name('csv.destroy');
Route::post('admin/importdata', [PetaController::class, 'importCSV'])->name('import-csv.import');
Route::post('/import-geojson', [PetaController::class, 'importGeoJSON'])->name('import.geojson');
Route::get('/admin/import-geo', [PetaController::class, 'showFormGeo'])->name('import-geo.form');
Route::get('/admin/getgeojson', [PetaController::class, 'getGeoJson'])->name('getdata');

