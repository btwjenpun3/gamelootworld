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
            $links =$responses['links'];
            $message = "Postingan berhasil di update.\n\n";
            foreach ($titles as $index => $title) {
                // Pastikan ada elemen yang sesuai dalam array $links
                if (isset($links[$index])) {
                    $link = $links[$index];
                    $message .= '- ' . $title . ' (' . $link . ")\n\n";
                }
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