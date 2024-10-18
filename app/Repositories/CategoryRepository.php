<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public static function create($name)
    {
        return Category::create(
            [
                'name' => $name,
            ]
        );
    }

    public static function getByName($name)
    {
        return Category::whereName($name)->first();
    }
}
