<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'RegisterRequest',
    required: ['name', 'email', 'password', 'password_confirmation'],
    properties: [
        new OAT\Property(
            property: 'name',
            type: 'string',
            example: 'John Doe'
        ),
        new OAT\Property(
            property: 'email',
            type: 'string',
            format: 'email',
            example: 'john@example.com'
        ),
        new OAT\Property(
            property: 'password',
            type: 'string',
            example: '123456'
        ),
        new OAT\Property(
            property: 'password_confirmation',
            type: 'string',
            example: '123456'
        ),
    ]
)]
class RegisterRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'string','unique:users,name','min:3','max:15'],
            'email' => ['required', 'string', 'email','unique:users,email','min:8','max:36'],
            'password' => ['required', 'string','min:3','max:25'],
            'password_confirmation' => ['required', 'string','min:3','max:25'],
            ];
    }
}
