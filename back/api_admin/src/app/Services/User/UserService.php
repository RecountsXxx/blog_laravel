<?php

namespace App\Services\User;

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\User\UserRepository;

class UserService
{

    public function __construct(private UserRepository $userRepository){}

    public function index(){
        return $this->userRepository->all();
    }

    public function store(array $data){
        return $this->userRepository->create($data);
    }

    public function destroy($id){
        $user = $this->userRepository->findOrFail($id);
        return $this->userRepository->delete($user);
    }

    public function ban_comments(string $id)
    {
        $user = $this->userRepository->findOrFail($id);
        $this->userRepository->update($user,['is_banned_comments'=>1]);
    }

    public function ban_posts(string $id)
    {
        $user = $this->userRepository->findOrFail($id);
        $this->userRepository->update($user,['is_banned_posts'=>true]);
    }

    public function unban(string $id)
    {
        $user = $this->userRepository->findOrFail($id);
        $this->userRepository->update($user,['is_banned_posts'=>false]);
        $this->userRepository->update($user,['is_banned_comments'=>false]);
    }
}
