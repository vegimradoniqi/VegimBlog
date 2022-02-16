<?php


namespace App\Providers;


use App\Repositories\BlogRepository;
use App\Repositories\BlogsServiceRepository;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\BlogsServiceRepositoryInterface;
use App\Repositories\Interfaces\LoginRepositoryInterface;
use App\Repositories\Interfaces\RegisterRepositoryInterface;
use App\Repositories\LoginRepository;
use App\Repositories\RegisterRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
        $this->app->bind(RegisterRepositoryInterface::class, RegisterRepository::class);
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(BlogsServiceRepositoryInterface::class, BlogsServiceRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
