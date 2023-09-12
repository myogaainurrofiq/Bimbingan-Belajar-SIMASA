<?php

use Illuminate\Support\Facades\Route;

Route::resource('backend-kelas', 'KelasController');
Route::post('kelas/tambah-murid', 'KelasController@tambahMurid');
