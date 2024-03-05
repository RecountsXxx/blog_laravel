<?php

namespace App\Models\Category;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function updatePostCount()
    {
        $this->post_count = $this->posts()->count();
        $this->save();
    }
}
