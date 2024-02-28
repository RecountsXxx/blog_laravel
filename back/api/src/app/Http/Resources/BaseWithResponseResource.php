<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BaseWithResponseResource extends JsonResource
{
    protected int $statusCode;

    public function __construct(?array $data, string $message, int $statusCode = ResponseAlias::HTTP_OK, string $status = null)
    {
        $this->statusCode = $statusCode;

        $result = new BaseResource($data, $message, $status);

        parent::__construct($result->resource);
    }

    public function withResponse($request, $response): void
    {
        $response->setStatusCode($this->statusCode);
    }
}
