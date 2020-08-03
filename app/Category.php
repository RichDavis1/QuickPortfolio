<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The rules for the Problem model.
     *
     * @var mixed[]
     */
    public static $rules = [
        'label' => ['required', 'string', 'max:50', 'unique:categories'],
        'slug' => ['slug', 'string', 'max:200', 'unique:categories']
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'slug', 'label'
    ];
}
