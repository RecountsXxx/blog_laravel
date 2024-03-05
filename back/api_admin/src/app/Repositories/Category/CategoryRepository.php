<?php

namespace App\Repositories\Category;

use App\Models\Category\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function count()
    {
        return DB::table('categories')->count();
    }

}
