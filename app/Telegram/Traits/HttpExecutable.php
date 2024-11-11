<?php

namespace App\Telegram\Traits;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

trait HttpExecutable
{
    public function sendHttp(string $action, array $data = []): Response
    {
        $botKey = config('services.telegram.key');

        return Http::post("https://api.telegram.org/bot{$botKey}/{$action}", $data);
    }
}
