<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use App\Http\Controllers\Fetch\FetchController;
use App\Models\FetchStatus;

class UpdateCommand extends Command
{
    protected string $name = 'update';
    protected string $description = 'Start Command to get you started';

    public function handle()
    {
        $update = new FetchController();
        $response = $update->updateGameContentFromUpstream();
        $data = json_decode($response, true);

        $this->replyWithMessage([
            'text' => $data,
        ]);
    }
}