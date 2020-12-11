<?php


namespace App\Providers;

use App\Repositories\Offers\OfferRepository;
use App\Repositories\Offers\OfferRepositoryInterface;
use App\Repositories\OfferUsers\OfferUserRepository;
use App\Repositories\OfferUsers\OfferUserRepositoryInterface;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Products\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            OfferRepositoryInterface::class,
            OfferRepository::class
        );

        $this->app->bind(
            OfferUserRepositoryInterface::class,
            OfferUserRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
    }
}
