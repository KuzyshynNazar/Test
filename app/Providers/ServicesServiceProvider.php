<?php


namespace App\Providers;

use App\Services\Offers\OfferService;
use App\Services\Offers\OfferServiceInterface;
use App\Services\OfferUsers\OfferUserService;
use App\Services\OfferUsers\OfferUserServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    public function register(){
        $this->app->bind(
            OfferServiceInterface::class,
            OfferService::class
        );

        $this->app->bind(
            OfferUserServiceInterface::class,
            OfferUserService::class
        );
    }
}
