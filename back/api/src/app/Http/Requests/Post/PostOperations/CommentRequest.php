<?php

namespace App\Http\Requests\Post\PostOperations;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'CommentRequest',
    properties: [
        new OAT\Property(
            property: 'comment_text',
            type: 'string',
            example: 'I like codding in react'
        ),
        new OAT\Property(
            property: 'author_id',
            type: 'int',
            example: '2'
        ),
        new OAT\Property(
            property: 'post_id',
            type: 'int',
            example: '2'
        ),
    ]
)]
#[OAT\Schema(
    schema: 'CommentResponse',
    properties: [
        new OAT\Property(
            property: 'id',
            type: 'int',
            example: '1'
        ),
        new OAT\Property(
            property: 'comment_text',
            type: 'string',
            example: 'I like codding in react'
        ),
        new OAT\Property(
            property: 'author_id',
            type: 'int',
            example: '2'
        ),
        new OAT\Property(
            property: 'post_id',
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
class CommentRequest extends FormRequest
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
            'post_id' => ['required','int','exists:posts,id'],
            'author_id' => ['required','int','exists:users,id'],
            'comment_text' => ['required','string','max:255','min:3']
        ];
    }
}
