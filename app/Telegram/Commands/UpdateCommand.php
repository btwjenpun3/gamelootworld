<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use App\Http\Controllers\Fetch\FetchController;
use App\Models\FetchStatus;

class UpdateCommand extends Command
{
    protected string $name = 'update';
    protected string $description = 'Ini adalah command untuk update post otomatis dari Telegram yang baru 2';

    public function handle()
    {
        $update = new FetchController();
        $responses = $update->updateGameContentFromUpstreamToTelegram();
        foreach($responses['titles'] as $response => $title) {
            return $response;
        }
        if(isset($responses['titles'])){
            $this->replyWithMessage([
            'text' => $response.'dengan judul game'.$title,
        ]);
        } else {
            $this->replyWithMessage([
            'text' => $response['message'],
        ]);
        }       
    }
}