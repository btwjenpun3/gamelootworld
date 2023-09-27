<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;


class TelegramController extends Controller
{
    public function setWebhook() {
        $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);
        dd($response);
    }    

    public function commandHandlerWebHook() {
        $updates = Telegram::commandsHandler(true);
        $chat_id = $updates->getChat()->getId();
        $username = $updates->getChat()->getFirstName();

        if(strtolower($updates->getMessage()->getText() === 'halo')) {
            return Telegram::sendMessage([
                'chat_id' => $chat_id,
                'text' => 'Halo'.$username 
            ]);
        }
    }
}
