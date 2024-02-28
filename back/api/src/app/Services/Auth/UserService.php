<?php

namespace App\Services\Auth;

use App\Jobs\Account\GenerateGravatarForUser;
use App\Notifications\SendVerificationMailNotification;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserService
{
    public function __construct(private UserRepository $userRepository){}

    public function create(array $data): Model
    {
        $data['confirmation_token'] = Str::uuid();
        $user = $this->userRepository->create($data);

        $user->notify(new SendVerificationMailNotification($user));

        GenerateGravatarForUser::dispatch($user->id)->onQueue('avatars.jobs');

        return $user;
    }
    public function findOrFail($email)
    {
        return $this->userRepository->get(['email'=>$email],true);
    }

}
