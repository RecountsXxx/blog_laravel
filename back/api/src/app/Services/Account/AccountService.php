<?php


namespace App\Services\Account;

use App\Repositories\User\UserRepository;

class AccountService
{

    public function __construct(private UserRepository $userRepository){}

    public function ConfirmEmail($id,$token)
    {
        $user = $this->userRepository->get(['id'=>$id, 'confirmation_token'=>$token], true);
        if($user->email_verified){
            return redirect('/');
        }
        $this->userRepository->update($user,['email_verified'=>true]);

        return redirect('/');
    }

    public function UpdateUserData($data){
        $user = $this->userRepository->findOrFail($data['user_id']);
            if (isset($data['name'])) {
                $this->userRepository->update($user, ['name' => $data['name']]);
            }
            if (isset($data['password'])) {
                $this->userRepository->update($user, ['password' => $data['password']]);
            }
    }
}
