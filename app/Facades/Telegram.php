<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Telegram\Bot\Bot;
use App\Telegram\Strategies\SendMessageStrategy;

class Telegram extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Bot::class;
    }

    public static function sendMessage(
        string $text,
        string $chatId,
        ?array $replyMarkup = null,
        string $parseMode = 'html',
    ): mixed {
        $bot = static::getFacadeRoot();

        $sendMessageStrategy = new SendMessageStrategy(
            $text,
            $replyMarkup,
            $parseMode,
            $chatId
        );

        $bot->setTelegramStrategy($sendMessageStrategy);

        return $bot->executeTelegramStrategy();
    }
}
