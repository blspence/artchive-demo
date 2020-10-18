<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // alias components in the views/components directory
        Blade::component('components.card', 'card');
        Blade::component('components.output', 'output');
        Blade::component('components.profile_photo', 'profile_photo');
        Blade::component('components.table', 'table');
        Blade::component('components.required_field', 'required_field');

        // alias includes in the views/includes directory
        Blade::include('includes.button', 'button');
        Blade::include('includes.buttons_confirm_cancel', 'buttons_confirm_cancel');
        Blade::include('includes.dropdown', 'dropdown');
        Blade::include('includes.input', 'input');
        Blade::include('includes.profile', 'profile');
        Blade::include('includes.table_header', 'table_header');
        Blade::include('includes.user', 'user');
        Blade::include('includes.textarea', 'textarea');
    }
}
