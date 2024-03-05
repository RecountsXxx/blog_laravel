<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $userService){}

    public function index(): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $users = $this->userService->index();
            return new BaseWithResponseResource([$users], 'show users', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->userService->destroy($id);
            return new BaseWithResponseResource(null, 'delete user', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function ban_posts(string $id): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->userService->ban_posts($id);
            return new BaseWithResponseResource(null, 'banned posts', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function ban_comments(string $id): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->userService->ban_comments($id);
            return new BaseWithResponseResource(null, 'banned comments', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function unban(string $id): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->userService->unban($id);
            return new BaseWithResponseResource(null, 'unban', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
