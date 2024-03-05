<?php

namespace App\Services\Report;

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Report\ReportPostRepository;
use App\Repositories\User\UserRepository;

class ReportPostService
{
    public function __construct(private ReportPostRepository $postRepository){}

    public function index(){
        return $this->postRepository->report_and_post();
    }

    public function destroy($id){
        $user = $this->postRepository->findOrFail($id);
        return $this->postRepository->delete($user);
    }
}
