<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OAT;


#[OAT\Schema(
    schema: 'CategoryResponse',
    properties: [
        new OAT\Property(
            property: 'id',
            type: 'int',
            example: '1'
        ),
        new OAT\Property(
            property: 'name',
            type: 'string',
            example: 'News'
        ),
        new OAT\Property(
            property: 'post_count',
            type: 'int',
            example: '3'
        ),
        new OAT\Property(
            property: 'created_at',
            type: 'datetime',
            example: '2024-02-06T19:22:50.000000Z'
        ),
        new OAT\Property(
            property: 'updated_at',
            type: 'datetime',
            example: '2024-02-06T19:22:50.000000Z'
        ),

    ]
)]

#[OAT\Schema(
    schema: 'CategoryRequest',
    properties: [
        new OAT\Property(
            property: 'name',
            type: 'string',
            example: 'News'
        ),

    ]
)]
class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string'],
        ];
    }
}
