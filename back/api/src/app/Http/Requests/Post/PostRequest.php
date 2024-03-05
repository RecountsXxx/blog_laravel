<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;


use OpenApi\Attributes as OAT;
#[OAT\Schema(
    schema: 'PostRequest',
    properties: [
        new OAT\Property(
            property: 'title',
            type: 'string',
            example: 'How to create react app'
        ),
        new OAT\Property(
            property: 'text',
            type: 'string',
            example: 'I like codding in react'
        ),
        new OAT\Property(
            property: 'author_id',
            type: 'int',
            example: '2'
        ),
        new OAT\Property(
            property: 'category_id',
            type: 'int',
            example: '2'
        ),
    ]
)]

#[OAT\Schema(
    schema: 'PostResponse',
    properties: [
        new OAT\Property(
            property: 'title',
            type: 'string',
            example: 'How to create react app'
        ),
        new OAT\Property(
            property: 'text',
            type: 'string',
            example: 'I like codding in react'
        ),
        new OAT\Property(
            property: 'author_id',
            type: 'int',
            example: '2'
        ),
        new OAT\Property(
            property: 'category_id',
            type: 'int',
            example: '2'
        ),
        new OAT\Property(
            property: 'views_count',
            type: 'int',
            example: '2'
        ),
        new OAT\Property(
            property: 'likes_count',
            type: 'int',
            example: '2'
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
class PostRequest extends FormRequest
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
            'title' => ['required','string','min:6','max:36'],
            'text' => ['required','string','min:50'],
            'category_id' => ['int','required','exists:categories,id'],
            'author_id' => ['int','required','exists:users,id'],
        ];
    }
}
