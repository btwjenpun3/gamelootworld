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
        if(isset($responses['titles'])){
            $titles = $responses['titles'];
            $message = 'Postingan berhasil di update.\nJudul Game :\n';
            foreach($titles as $title) {
                $message .= '- ' . $title . '\n';
            }
            $this->replyWithMessage([
            'text' => $message,
            'parse_mode' => 'Markdown',
        ]);
        } else {
            $this->replyWithMessage([
            'text' => $responses['message'],
        ]);
        }       
    }
}