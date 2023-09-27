<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;


class TelegramController extends Controller
{
    public function show() {
        $response = Telegram::sendMessage([
            'chat_id' => '184922928',
            'text' => 'Hello World'
        ]);

        $messageId = $response->getMessageId();

        return $messageId;

    }
}
