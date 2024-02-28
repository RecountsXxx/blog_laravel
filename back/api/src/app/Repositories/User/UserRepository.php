<?php

namespace App\Repositories\User;

use App\Models\User\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct( User $user)
    {
        parent::__construct($user);
    }


}
