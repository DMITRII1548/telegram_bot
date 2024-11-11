<?php

namespace Tests\Feature;

use App\Facades\Telegram;
use Tests\TestCase;

class TelegramFacadeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_send_message(): void
    {
        $this->withExceptionHandling();

        $response = Telegram::sendMessage('test', env('TEST_TELEGRAM_CHAT_ID', ''));

        $this->assertEquals($response['ok'], true);
        $this->assertEquals($response['result']['text'], 'test');
    }

    public function test_send_message_with_button(): void
    {
        $response = Telegram::sendMessage('test', env('TEST_TELEGRAM_CHAT_ID', ''), [
            'inline_keyboard' => [
                [
                    [
                        'text' => 'click',
                        'url' => 'https://laravel.com'
                    ]
                ]
            ],
        ]);

        $this->assertEquals($response['ok'], true);
        $this->assertEquals($response['result']['text'], 'test');
        $this->assertEquals($response['result']['reply_markup']['inline_keyboard'][0][0]['text'], 'click');
        $this->assertEquals($response['result']['reply_markup']['inline_keyboard'][0][0]['url'], 'https://laravel.com/');
    }
}
