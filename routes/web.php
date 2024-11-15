<?php

use App\Facades\Telegram;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Symfony\Component\DomCrawler\Crawler;



Route::get('/', function () {
    Telegram::sendMessage('hi', '5237646392');

    return view('welcome');
});
