<?php

namespace Nel\BookingSystem;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class BookingSystemServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'booking-system');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/booking-system'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // $this->publishesMigrations([
        //     __DIR__.'/database/migrations' => database_path('migrations'),
        // ]);

        $this->mergeConfigFrom(__DIR__.'/../config/booking-system.php', 'booking-system');

        $this->publishes([
            __DIR__.'/../config/booking-system.php' => config_path('booking-system.php'),
        ]);

        // Register Livewire components
        Livewire::component('booking-calendar', \Nel\BookingSystem\Http\Livewire\BookingCalendar::class);
        Livewire::component('create-booking', \Nel\BookingSystem\Http\Livewire\CreateBooking::class);
        Livewire::component('show-selebookingction', \Nel\BookingSystem\Http\Livewire\ShowBooking::class);
    }

}
