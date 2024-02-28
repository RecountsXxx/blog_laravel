<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'SuccessLoginResource',
    properties: [
        new OAT\Property(
            property: 'status',
            type: 'string',
            example: 'true'
        ),
        new OAT\Property(
            property: 'user',
            type: 'object',
            ref: '#/components/schemas/Admin'
        ),
        new OAT\Property(
            property: 'authorisation',
            type: 'object',
            ref: '#/components/schemas/TokenResource'
        ),
    ]
)]
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
