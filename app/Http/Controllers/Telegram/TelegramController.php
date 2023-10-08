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
    }    

    public function commandHandlerWebHook() {
        $updates = Telegram::commandsHandler(true);        
    }
}
