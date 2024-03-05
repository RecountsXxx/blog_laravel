<?php

namespace App\Services\Admin;

use App\Repositories\Admin\AdminRepository;

class AdminService
{
    public function __construct(private AdminRepository $adminRepository){}

    public function index(){
        return $this->adminRepository->all();
    }

    public function store(array $data){
        return $this->adminRepository->create($data);
    }

    public function destroy($id){
        $admin = $this->adminRepository->findOrFail($id);
        return $this->adminRepository->delete($admin);
    }
}
