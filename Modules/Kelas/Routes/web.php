<?php

use Illuminate\Support\Facades\Route;

Route::resource('backend-kelas', 'KelasController');
Route::post('backend-kelas/tambah-murid', 'KelasController@tambahMurid');
