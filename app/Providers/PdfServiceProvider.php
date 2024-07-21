<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mpdf\Mpdf;

class PdfServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('pdf', function ($app) {
            return new Mpdf();
        });
    }

    public function boot()
    {
        //
    }
}
