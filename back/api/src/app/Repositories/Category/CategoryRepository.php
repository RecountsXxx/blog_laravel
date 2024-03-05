<?php

namespace App\Repositories\Category;

use App\Models\Category\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

}
