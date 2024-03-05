<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:9', 'unique:admins,name'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:3', 'max:24'],

        ];
    }
}
