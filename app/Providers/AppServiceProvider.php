<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Order;
use App\Policies\ProductPolicy;
use App\Policies\OrderPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register Policies
        Gate::policy(Product::class, ProductPolicy::class);
        Gate::policy(Order::class, OrderPolicy::class);
        
        // Optional: Define gates for super admin
        // Gate::define('manage-users', function ($user) {
        //     return $user->isAdmin();
        // });
    }
}