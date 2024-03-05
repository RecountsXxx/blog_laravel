<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Category\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService) {}

    public function index(): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $categories = $this->categoryService->index();
            return new BaseWithResponseResource(['categories' => $categories], 'Get all categories', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function store(CategoryRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $category = $this->categoryService->store($request->name);
            return new BaseWithResponseResource([$category], 'Category created', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function destroy(string $id): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->categoryService->destroy($id);
            return new BaseWithResponseResource(null, 'Category deleted', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
