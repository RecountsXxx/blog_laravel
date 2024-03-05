<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepository;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository){}

    public function index(){
        return $this->categoryRepository->all();
    }

    public function store($name){
        return $this->categoryRepository->create(['name' => $name]);
    }

    public function destroy($id){
        $category = $this->categoryRepository->findOrFail($id);
        return $this->categoryRepository->delete($category);
    }
}
