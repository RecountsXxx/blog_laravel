<?php

namespace app\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserChangeUsernameController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {

    }

    public function __invoke()
    {
          return 'asd';
    }

}
