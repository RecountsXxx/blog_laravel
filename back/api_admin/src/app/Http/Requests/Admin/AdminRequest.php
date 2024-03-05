<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => ['required', 'string','min:3','max:9','exists:admins,name'],
            'email' => ['required', 'string', 'email','min:3','max:255','exists:admins,email'],
            'password' => ['required', 'string','min:3','max:24'],
        ];
    }

}
