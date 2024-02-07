<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserChangePasswordController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {

    }

    public function __invoke()
    {

    }

}
