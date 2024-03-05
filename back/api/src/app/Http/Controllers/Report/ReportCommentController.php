<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\ReportCommentRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Report\ReportService;
use OpenApi\Attributes as OAT;

class ReportCommentController extends Controller
{
    public function __construct(private ReportService $reportService){}

    #[OAT\Post(
        tags: ['report'],
        path: '/api/report/comment',
        summary: 'report comment',
        operationId: 'api.report.comment',
        requestBody: new OAT\RequestBody(
            required: true,
            description: "upload avatar ",
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'comment_id',
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
                description: 'report comment',
                content: new OAT\JsonContent(
                    properties: [
                    ]
                )
            ),
        ],
    )]

    public function __invoke(ReportCommentRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $report = ['comment_id'=>$request->comment_id,'who_report_id'=>$request->who_was_reported_id];
            $this->reportService->reportComment($report);

            return new BaseWithResponseResource(null, 'report comment','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
