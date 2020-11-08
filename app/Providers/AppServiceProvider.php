<?php

namespace App\Providers;

use App\Repository\IcomeRepository;
use App\Repository\Impl\IcomeEloquentImpl;
use App\Repository\Impl\PaymentEloquentImpl;
use App\Repository\Impl\PersonEloquentImpl;
use App\Repository\Impl\ProductEloquentImpl;
use App\Repository\Impl\ProviderEloquentImpl;
use App\Repository\Impl\SaleEloquentImpl;
use App\Repository\Impl\USerEloquentImpl;
use App\Repository\Impl\CreditEloquentImpl;
use App\Repository\PaymentRepository;
use App\Repository\PersonRepository;
use App\Repository\ProductRepository;
use App\Repository\ProviderRepository;
use App\Repository\SaleRepository;
use App\Repository\UserRepository;
use App\Repository\CreditRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\CategoryRepository',
            'App\Repository\Impl\CategoryEloquentImpl'
        );

        $this->app->bind(
            ProductRepository::class,
            ProductEloquentImpl::class
        );

        $this->app->bind(
            PersonRepository::class,
            PersonEloquentImpl::class
        );

        $this->app->bind(
            ProviderRepository::class,
            ProviderEloquentImpl::class
        );

        $this->app->bind(
            UserRepository::class,
            USerEloquentImpl::class
        );

        $this->app->bind(
            IcomeRepository::class,
            IcomeEloquentImpl::class
        );

        $this->app->bind(
            SaleRepository::class,
            SaleEloquentImpl::class
        );

        $this->app->bind(
            CreditRepository::class,
            CreditEloquentImpl::class
        );

        $this->app->bind(
            PaymentRepository::class,
            PaymentEloquentImpl::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
