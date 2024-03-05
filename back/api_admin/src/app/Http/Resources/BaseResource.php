<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class BaseResource extends JsonResource
{
    protected string $status = 'success';
    protected string $message;

    public function __construct(?array $data, string $message, string $status = null)
    {
        if ($status !== null) {
            $this->status = $status;
        }

        $this->message = $message;

        $result = [
            'status' => $this->status,
            'message' => $this->message
        ];

        if (!empty($data)) {
            $result = array_merge($result, $data);
        }

        parent::__construct($result);
    }
}
