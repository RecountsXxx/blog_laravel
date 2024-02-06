<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use OpenApi\Attributes as OAT;
class CategoryController extends Controller
{
    public function __construct(private CategoryRepository $categoryRepository)
    {

    }


    #[OAT\Get(
        tags: ['categories'],
        path: '/api/category',
        summary: 'Get all categories',
        operationId: 'api.category.index',
        responses: [
            new OAT\Response(
                response: 200,
                description: 'retun all categories',
                content: new OAT\JsonContent(ref: '#/components/schemas/CategoryResponse')
            ),
        ],
    )]
    public function index()
    {
         return $this->categoryRepository->all();
    }
    #[OAT\Post(
        tags: ['categories'],
        path: '/api/category',
        summary: 'Add category',
        operationId: 'api.category.store',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(ref: '#/components/schemas/CategoryRequest')
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'return new created category',
                content: new OAT\JsonContent(ref: '#/components/schemas/CategoryResponse')
            ),
            new OAT\Response(
                response: 400,
                description: 'return error if category is exitst',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'error',
                            type: 'string',
                            example: 'this category already exists'
                        ),
                    ]
                )
            ),
        ],
    )]
    public function store(CategoryRequest $request)
    {
        if($this->categoryRepository->get(['name'=>$request->name]) != null){
            return response()->json(['error'=>'this category already exists']);
        }

        $category = $this->categoryRepository->create(['name'=>$request->name]);
        return response()->json($category);
    }
    #[OAT\Get(
        tags: ['categories'],
        path: '/api/category/{$id}',
        summary: 'Show category per id',
        operationId: 'api.category.show',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'id',
                        type: 'int',
                        example: '9'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'return category',
                content: new OAT\JsonContent(ref: '#/components/schemas/CategoryResponse')
            ),
            new OAT\Response(
                response: 400,
                description: 'return error if category is not exists',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'error',
                            type: 'string',
                            example: 'not found'
                        ),
                    ]
                )
            ),
        ],
    )]
    public function show(string $id)
    {
        $category = $this->categoryRepository->get(['id' => $id]);
        if($category == null){
            return response()->json(['error'=>'not found']);
        }
        return response()->json($category);
    }
    #[OAT\Put(
        tags: ['categories'],
        path: '/api/category',
        summary: 'Update category per id',
        operationId: 'api.category.update',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'id',
                        type: 'int',
                        example: '9'
                    ),
                    new OAT\Property(
                        property: 'name',
                        type: 'string',
                        example: 'new name'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'return category',
                content: new OAT\JsonContent(ref: '#/components/schemas/CategoryResponse')
            ),
            new OAT\Response(
                response: 400,
                description: 'return error if category is not exists',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'error',
                            type: 'string',
                            example: 'not found'
                        ),
                    ]
                )
            ),
        ],
    )]
    public function update(CategoryRequest $request, string $id)
    {
        $category = $this->categoryRepository->get(['id' => $id]);
        if($category == null){
            return response()->json(['error'=>'not found']);
        }
        $this->categoryRepository->update($category,['name'=>$request->name]);
        $category = $this->categoryRepository->get(['id'=>$id]);
        return response()->json($category);
    }
    #[OAT\Delete(
        tags: ['categories'],
        path: '/api/category/{$id}',
        summary: 'Delete category per id',
        operationId: 'api.category.destroy',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'id',
                        type: 'int',
                        example: '9'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'return message',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'string',
                            type: 'string',
                            example: 'deleted category: 9'
                        ),
                    ]
                )
            ),
            new OAT\Response(
                response: 400,
                description: 'return error if category is not exists',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'error',
                            type: 'string',
                            example: 'not found'
                        ),
                    ]
                )
            ),
        ],
    )]
    public function destroy(string $id)
    {
        $category = $this->categoryRepository->get(['id' => $id]);
        if($category == null){
            return response()->json(['error'=>'not found']);
        }
       $this->categoryRepository->delete($category);
       return response()->json(['message'=>'Deleted category: ' . $id]);
    }

}
