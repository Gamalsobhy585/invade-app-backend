<?php

namespace app\Repositories\Implementation;

use app\Models\Category;
use app\Repositories\Interface\ICategory;

class CategoryRepository implements ICategory
{
    public function get()
    {
        return Category::all();

    }

    public function save($model)
    {
    return  Category::create($model);
    }

}
