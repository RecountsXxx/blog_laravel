<?php

namespace App\Models\User;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OpenApi\Attributes as OAT;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

#[OAT\Schema(
    schema: 'Admin',
    properties: [
        new OAT\Property(
            property: 'id',
            type: 'int',
            example: '2'
        ),
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
            property: 'email_verified',
            type: 'boolean',
            example: '1'
        ),
        new OAT\Property(
            property: 'created_at',
            type: 'datetime',
            example: '2024-02-03T21:06:04.000000Z'
        ),
        new OAT\Property(
            property: 'updated_at',
            type: 'datetime',
            example: '2024-02-03T21:06:04.000000Z'
        ),
        new OAT\Property(
            property: 'confirmation_token',
            type: 'url',
            example: '8ccde004-4c26-453e-a3f7-a73145dfb4a1'
        ),
        new OAT\Property(
            property: 'avatar_url',
            type: 'string',
            example: 'http://localhost/storage/avatars/108/original.webp'
        ),
    ]
)]
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirmation_token',
        'email_verified',
        'avatar_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //put these methods at the bottom of your class body

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'email'=>$this->email,
            'name'=>$this->name
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
