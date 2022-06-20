<?php

namespace App\Providers;

use App\MoneyHelper;
use App\PrometheusMonitor;
use Clickadilla\LaravelSocialProvider\Clients\SocialProviderClient;
use Clickadilla\PrometheusMonitoring\Monitor;
use Illuminate\Pagination\Paginator;
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
        //
    }

    public function boot()
    {
        Paginator::useBootstrap();

        $this->app->bind(MoneyHelper::class, function ($app) {
            return new MoneyHelper(config('money.currencies'));
        });

        $this->app->bind(Monitor::class, PrometheusMonitor::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->singleton(SocialProviderClient::class, function () {
            return (new SocialProviderClient(
                config('services.social_provider.endpoint')
            ))->setToken(
                config('services.social_provider.token')
            );
        });
    }
}
