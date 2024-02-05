<?php

namespace App\Jobs\Account;

use App\Services\Account\AvatarService;
use App\Services\Socket\SocketService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateGravatarForUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $user_id;

    public function __construct(int $user_id)
    {
        \Laravel\Prompts\info("consturctor job");
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     */
    public function handle(AvatarService $avaService, SocketService $socketService): void
    {
        \Laravel\Prompts\info("handle job");
        $avaService->createAvatar($this->user_id);
        $socketService->emit('socket.php', "From Job aaas " . date('Y-m-d H:i:s'));

    }
}
