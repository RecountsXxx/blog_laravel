<?php

namespace App\Http\Resources\Errors;

use App\Http\Resources\BaseWithResponseResource;
use OpenApi\Attributes as OAT;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

#[OAT\Schema(
    schema: 'InternalServerErrorResource',
    properties: [
        new OAT\Property(
            property: 'status',
            type: 'string',
            example: 'failure'
        ),
        new OAT\Property(
            property: 'message',
            type: 'string',
            example: 'Internal server error'
        )
    ]
)]
class InternalServerErrorResource extends BaseWithResponseResource
{
    public function __construct(?array $data, string $message = 'Internal server error')
    {
        parent::__construct($data, $message, ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, 'failure');
    }
}
