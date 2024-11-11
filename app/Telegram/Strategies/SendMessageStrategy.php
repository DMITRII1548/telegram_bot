<?php

namespace App\Telegram\Strategies;

class SendMessageStrategy extends TelegramStrategy
{
    public function __construct(
        private string $text,
        private ?array $replyMarkup = null,
        private string $parseMode = 'html',
        private string $chatId,
    ) {}

    public function execute(): void
    {
        $this->response = $this->sendHttp(
                'sendMessage',
                $this->prepareQuery()
            )
            ->json();
    }

    private function prepareQuery(): array
    {
        $query = [
            'text' => $this->text,
            'parse_mode' => $this->parseMode,
            'chat_id' => $this->chatId,
        ];

        if ($this->replyMarkup) {
            $query['reply_markup'] = $this->replyMarkup;
        }

        return $query;
    }
}
