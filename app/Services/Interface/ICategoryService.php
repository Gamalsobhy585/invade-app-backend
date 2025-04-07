<?php

namespace App\Services\Interface;

interface ICategoryService
{
    public function getCategories($request);
    public function store($request);

}
