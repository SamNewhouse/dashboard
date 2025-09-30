<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard/{any?}', function () {
  return view('dashboard');
})->where('any', '.*')->name('dashboard');
