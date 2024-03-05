<?php

namespace App\Services\Dashboard;

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Report\ReportCommentRepository;
use App\Repositories\Report\ReportPostRepository;
use App\Repositories\User\UserRepository;

class DashboardService
{
    protected $postRepository;
    protected $userRepository;
    protected $adminRepository;
    protected $reportPostRepository;
    protected $reportCommentRepository;
    protected $categoryRepository;

    public function __construct(
        PostRepository $postRepository,
        UserRepository $userRepository,
        AdminRepository $adminRepository,
        ReportCommentRepository $reportCommentRepository,
        ReportPostRepository $reportPostRepository,
        CategoryRepository $categoryRepository
    ) {
        [
            $this->postRepository,
            $this->userRepository,
            $this->adminRepository,
            $this->reportCommentRepository,
            $this->reportPostRepository,
            $this->categoryRepository
        ] = func_get_args();
    }

    public function index()
    {
        $stats = [
            'posts' => $this->postRepository->count(),
            'users' => $this->userRepository->count(),
            'admins' => $this->adminRepository->count(),
            'reports_posts' => $this->reportPostRepository->count(),
            'reports_comments' => $this->reportCommentRepository->count(),
            'categories' => $this->categoryRepository->count(),
        ];

        return $stats;
    }
}
