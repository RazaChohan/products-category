<?php

namespace App\Providers;

use Dal\Repositories\CategoryRepository;
use Dal\Repositories\CategoryRepositoryInterface;
use Dal\Repositories\ProductRepository;
use Dal\Repositories\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider  extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Bind all interfaces with repositories
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }
}
