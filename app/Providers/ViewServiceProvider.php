<?php

namespace App\Providers;

use App\Breed;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('cats.edit', function ($view) {
            $breeds = Breed::all();
            if (count($breeds) > 0) {
                $breed_options = array_combine(
                    $breeds->pluck('id')->all(),
                    $breeds->pluck('name')->all()
                );
            } else {
                $breed_options = array(null, 'Unspecified');
            }
            $view->with('breed_options', $breed_options);
        });
    }
}
