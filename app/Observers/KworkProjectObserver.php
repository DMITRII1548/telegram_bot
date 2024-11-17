<?php

namespace App\Observers;

use App\Facades\Telegram;
use App\Models\KworkProject;
use Exception;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Log;

class KworkProjectObserver implements ShouldHandleEventsAfterCommit
{
    public function created(KworkProject $kworkProject): void
    {
        try {
            $message = (string)view('telegram.project', compact('kworkProject'));
            $projectId = $kworkProject->id;

            Telegram::sendMessage($message, config('services.telegram.chat_id'), [
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'Перейти',
                            'url' => "https://kwork.ru/projects/$projectId/view"
                        ]
                    ]
                ],
            ]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
