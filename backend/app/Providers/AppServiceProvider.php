<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
//Ho so ma hoa id
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
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
        
        
        Blade::directive('hashId', function ($id) {
            //random 5 kí tự
            $randomString = Str::random(5);
            $encryptedId = Crypt::encrypt($id);
            $encodeID =  substr_replace($encryptedId, $randomString, 4, 0);
            return $encodeID;
        });
    }
}
