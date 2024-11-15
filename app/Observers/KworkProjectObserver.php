<?php

namespace App\Observers;

use App\Facades\Telegram;
use App\Models\KworkProject;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Log;

class KworkProjectObserver implements ShouldHandleEventsAfterCommit
{
    public function created(KworkProject $kworkProject): void
    {
        Log::info('ok');
        $message = (string)view('telegram.project', compact('kworkProject'));
        $projectId = $kworkProject->id;

        Telegram::sendMessage($message, '5237646392', [
            'inline_keyboard' => [
                [
                    [
                        'text' => 'Перейти',
                        'url' => "https://kwork.ru/projects/$projectId/view"
                    ]
                ]
            ],
        ]);
    }
}
