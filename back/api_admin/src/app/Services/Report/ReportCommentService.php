<?php

namespace App\Services\Report;

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Report\ReportCommentRepository;
use App\Repositories\User\UserRepository;

class ReportCommentService
{
    public function __construct(private ReportCommentRepository $commentRepository){}

    public function index(){
         return $this->commentRepository->report_and_comment();
    }

    public function destroy($id){
        $user = $this->commentRepository->findOrFail($id);
        return $this->commentRepository->delete($user);
    }
}
