<?php

namespace App\Providers;

use App\ChargeCommision;
use App\Footer;
use App\General;
use App\Logo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $general = General::find(1);
        $charge = ChargeCommision::find(1);
        
        View::share(compact( 'general', 'charge'));
    }


//     public function register()
// {
//     $this->app->bind('path.public', function() {
//        return base_path('public_html');
//     });
// }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
