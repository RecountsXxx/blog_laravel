<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\ReportPostRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Report\ReportService;
use OpenApi\Attributes as OAT;

class ReportPostController extends Controller
{
    public function __construct(private ReportService $reportService){}

    #[OAT\Post(
        tags: ['report'],
        path: '/api/report/post',
        summary: 'report post',
        operationId: 'api.report.post',
        requestBody: new OAT\RequestBody(
            required: true,
            description: "upload avatar ",
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'post_id',
                        type: 'int',
                        example: '22'
                    ),
                    new OAT\Property(
                        property: 'who_was_reported_id',
                        type: 'int',
                        example: '33'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'report post',
                content: new OAT\JsonContent(
                    properties: [
                    ]
                )
            ),
        ],
    )]
    public function __invoke(ReportPostRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $report = ['post_id'=>$request->post_id,'who_report_id'=>$request->who_was_reported_id];
            $this->reportService->reportPost($report);

            return new BaseWithResponseResource(null, 'report post','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
