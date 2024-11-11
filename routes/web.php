<?php

use App\Facades\Telegram;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
