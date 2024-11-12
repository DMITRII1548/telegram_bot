<?php

use App\Facades\Telegram;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Symfony\Component\DomCrawler\Crawler;



Route::get('/', function () {
    $response = Http::get('https://kwork.ru/projects');
$html = (string)$response->body();

$crawler = new Crawler($html);

$script = $crawler->filter('script')->eq(11)->text();

if (preg_match('/window\.stateData\s*=\s*(\{.*\});/s', $script, $matches)) {
    // $matches[1] теперь содержит сам JSON-объект в виде строки
    $script = $matches[1];

    // Декодируем JSON в PHP массив
    $json = json_decode($script, true);

    dd($json);
}
    return view('welcome');
});
