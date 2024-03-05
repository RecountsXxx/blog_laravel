<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
class SuccessLoginResource extends JsonResource
{

    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(Response::HTTP_OK);
    }
}
