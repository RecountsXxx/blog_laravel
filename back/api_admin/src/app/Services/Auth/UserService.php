<?php

namespace App\Services\Auth;

use App\Repositories\Admin\AdminRepository;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    public function __construct(private AdminRepository $adminRepository){}

    public function create(array $data): Model
    {
        $admin = $this->adminRepository->create($data);

        return $admin;
    }
    public function findOrFail($email)
    {
        return $this->adminRepository->get(['email'=>$email],true);
    }

}
