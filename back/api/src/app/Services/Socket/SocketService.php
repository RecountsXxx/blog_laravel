<?php

namespace App\Services\Socket;
use SocketIO;
class SocketService
{
    protected $redis;
    protected $emitter;

    public function __construct()
    {
        $this->redis = new \Redis(); // Using the Redis extension provided client
        $this->redis->connect(env('REDIS_SOCKET_HOST', 'db.redis.socket'), env('REDIS_SOCKET_PORT', 6379));
        $this->emitter = new SocketIO\Emitter($this->redis);
    }

    public function emit(string $messageName, mixed $messageBody)
    {
        $this->emitter->emit($messageName, json_encode($messageBody));
    }


}
