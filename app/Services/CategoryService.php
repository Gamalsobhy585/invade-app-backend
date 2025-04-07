<?php

namespace app\Services;

use app\Repositories\Interface\ICategory;
use app\Traits\ResponseTrait;
use Illuminate\Support\Facades\Log;
use app\Http\Resources\CategoryResource;
use App\Services\Interface\ICategoryService;

class CategoryService implements ICategoryService
{
    private ICategory $Categoryrepo;

    public function __construct(ICategory $Categoryrepo)
    {
        $this->Categoryrepo = $Categoryrepo;
    }

    public function getCategories($request)
    {
        
    }

    public function store($request)
    {

    }


}
