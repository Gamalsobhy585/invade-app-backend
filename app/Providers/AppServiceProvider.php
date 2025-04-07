<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use app\Repositories\Interface\ITask;
use app\Repositories\Implementation\TaskRepository;
use app\Repositories\Interface\ICategory;
use app\Repositories\Implementation\CategoryRepository;
use app\Repositories\Implementation\UserRepository;
use App\Repositories\Interface\IUser;
use app\Services\Interface\IAuthService;
use app\Services\Interface\ITaskService;
use app\Services\Interface\ICategoryService;
use app\Services\AuthService;
use app\Services\TaskService;
use app\Services\CategoryService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
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
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }
}
