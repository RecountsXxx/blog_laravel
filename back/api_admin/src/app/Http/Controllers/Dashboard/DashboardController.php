<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Dashboard\DashboardService;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboardService){}

    public function index()
    {
        try {
            $reports = $this->dashboardService->index();
            return new BaseWithResponseResource([$reports], 'show dashboard','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
