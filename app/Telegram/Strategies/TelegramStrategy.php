<?php

namespace App\Telegram\Strategies;

use App\Telegram\Traits\HttpExecutable;

abstract class TelegramStrategy
{
    use HttpExecutable;
    
    protected mixed $response = null;

    public function getResponse(): mixed
    {
        return $this->response;
    }

    abstract public function execute(): void;
}
