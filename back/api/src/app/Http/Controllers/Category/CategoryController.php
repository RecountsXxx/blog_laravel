<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Category\CategoryService;
use OpenApi\Attributes as OAT;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService){}

    #[OAT\Get(
        tags: ['categories'],
        path: '/api/category',
        summary: 'Get all categories',
        operationId: 'api.category',
        responses: [
            new OAT\Response(
                response: 200,
                description: 'retun all categories',
                content: new OAT\JsonContent(ref: '#/components/schemas/CategoryResponse')
            ),
        ],
    )]

    public function __invoke(): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $categories = $this->categoryService->GetCategories();

            return new BaseWithResponseResource(['categories'=> $categories], 'Get all categories','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

}
