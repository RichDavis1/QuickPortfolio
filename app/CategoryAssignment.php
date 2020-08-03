<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryAssignment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_assignment';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'category_id', 'post_id', 'table'
    ];

    /**
     * Remove category.
     *
     * @param Category $category
     */
    public function removeCategory(Category $category) : void
    {
        CategoryAssignment::where('category_id', $category->id)->delete();
    }
}
