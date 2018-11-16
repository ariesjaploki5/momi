<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('contact', function ($attribute, $value, $parameters, $validator) {
                return preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $value) && strlen($value) >= 10;
        });
    

        Validator::replacer('contact', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, ':attribute is invalid contact number');
        });



    }

    public function register()
    {
        
    }
}
