<?php

namespace App\Telegram\Bot;

use App\Telegram\Strategies\TelegramStrategy;

class Bot
{
    private TelegramStrategy $telegramStrategy;

    public function setTelegramStrategy(TelegramStrategy $telegramStrategy): void
    {
        $this->telegramStrategy = $telegramStrategy;
    }

    public function executeTelegramStrategy(): mixed
    {
        $this->telegramStrategy->execute();

        return $this->telegramStrategy->getResponse();
    }
}
