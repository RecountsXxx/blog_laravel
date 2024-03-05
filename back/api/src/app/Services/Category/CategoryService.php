<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepository;

class CategoryService
{

    public function __construct(private CategoryRepository $categoryRepository){}

    public function GetCategories(){
        return $this->categoryRepository->all();
    }
}
