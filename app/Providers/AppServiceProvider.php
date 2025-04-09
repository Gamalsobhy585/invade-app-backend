<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interface\ITask;
use App\Repositories\Implementation\TaskRepository;
use App\Repositories\Interface\ICategory;
use App\Repositories\Implementation\CategoryRepository;
use App\Repositories\Implementation\UserRepository;
use App\Repositories\Interface\IUser;
use App\Services\Interface\IAuthService;
use App\Services\Interface\ITaskService;
use App\Services\Interface\ICategoryService;
use App\Services\AuthService;
use App\Services\TaskService;
use App\Services\CategoryService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {
        $this->app->bind(ITask::class, TaskRepository::class);
        $this->app->bind(ICategory::class, CategoryRepository::class);
        $this->app->bind(IUser::class,UserRepository::class);
        $this->app->bind(IAuthService::class,AuthService::class);
        $this->app->bind(ITaskService::class,TaskService::class);
        $this->app->bind(ICategoryService::class,CategoryService::class);
    

    }

    /**
     * Bootstrap any Application services.
     */
    public function boot()
    {
        //
    }
}
