<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->extend(HtmlSanitizerConfig::class, function (HtmlSanitizerConfig $config) {
            return $config
                ->allowAttribute('data-file-id', allowedElements: 'div')
                ->allowAttribute('data-file-name', allowedElements: 'div,a')
                ->allowAttribute('data-file-url', allowedElements: 'div')
                ->allowAttribute('data-mime-type', allowedElements: 'div');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
