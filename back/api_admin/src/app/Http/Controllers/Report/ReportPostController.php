<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Report\ReportPostService;

class ReportPostController extends Controller
{
    public function __construct(private ReportPostService $reportService){}

    public function index(): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $reports = $this->reportService->index();
            return new BaseWithResponseResource(([$reports] ?: null), 'show reports', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->reportService->destroy($id);
            return new BaseWithResponseResource(null, 'delete report', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
