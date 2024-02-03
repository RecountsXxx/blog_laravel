<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OAT;


#[
    OAT\Info(
        version: '1.0.0',
        title: 'Пример реализации социальной сети',
        description: "## Соцальная сеть Шаг и компания \n\n Наша проба сделать хорошую социальную сеть",
    ),
    OAT\Server(url: 'http://localhost', description: 'Local API server'),
    OAT\SecurityScheme(
        securityScheme: 'BearerToken',
        scheme: 'bearer',
        bearerFormat: 'JWT',
        type: 'http'
    ),
    OAT\Tag(name: 'auth', description: 'User authentication'),
    OAT\Tag(name: 'post', description: 'Операции с постами'),
    OAT\Schema(
        schema: 'ValidationError',
        properties: [
            new OAT\Property(property: 'message', type: 'string', example: 'The given data was invalid.'),
            new OAT\Property(
                property: 'errors',
                type: 'object',
                properties: [
                    new OAT\Property(
                        property: 'key 1',
                        type: 'array',
                        items: new OAT\Items(type: 'string', example: 'Error message 1')
                    ),
                    new OAT\Property(
                        property: 'key 2',
                        type: 'array',
                        items: new OAT\Items(type: 'string', example: 'Error message 2')
                    ),
                ]
            ),

        ]
    )
]
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


}
