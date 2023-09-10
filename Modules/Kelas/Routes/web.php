<?php

use Illuminate\Support\Facades\Route;

Route::resource('backend-kelas', 'kelasController');
Route::post('kelas/tambah-murid', 'kelasController@tambahMurid');
