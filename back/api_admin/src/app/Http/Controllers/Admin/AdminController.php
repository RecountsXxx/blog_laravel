<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Admin\AdminService;

class AdminController extends Controller
{
    public function __construct(private AdminService $adminService){}

    public function index(): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $admins = $this->adminService->index();
            return new BaseWithResponseResource([$admins], 'show admin', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function store(AdminRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $admin = $this->adminService->store($request->only(['name', 'email', 'password']));
            return new BaseWithResponseResource([$admin], 'added admin', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->adminService->destroy($id);
            return new BaseWithResponseResource(null, 'delete admin', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
