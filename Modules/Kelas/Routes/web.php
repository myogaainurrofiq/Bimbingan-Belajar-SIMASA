<?php

use Illuminate\Support\Facades\Route;

Route::resource('kelas', 'kelasController');
Route::post('kelas/tambah-murid', 'kelasController@tambahMurid');
