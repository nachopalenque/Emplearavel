<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use JeroenNoten\LaravelAdminLte\Events\DarkModeWasToggled;
use JeroenNoten\LaravelAdminLte\Events\ReadingDarkModePreference;
use Illuminate\Support\Facades\View;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */


    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,

        
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //

        

                Event::listen(
            ReadingDarkModePreference::class,
            [$this, 'handleReadingDarkModeEvt']
        );

 


        // Register listener for DarkModeWasToggled AdminLTE event.

        Event::listen(
            DarkModeWasToggled::class,
            [$this, 'handleDarkModeWasToggledEvt']
        );


    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }

    public function handleReadingDarkModeEvt(ReadingDarkModePreference $event)
    {
        // TODO: Implement the next method to get the dark mode preference for the
        // current authenticated user. Usually this preference will be stored on a database,
        // it is your task to get it.

    



    }


    public function handleDarkModeWasToggledEvt(DarkModeWasToggled $event)
    {
        // Get the new dark mode preference (enabled or not).



           dd('hola');

        // Store the new dark mode preference on the database.

        //$this->storeDarkModeSettingOnDB($darkModeCfg);

        // TODO: Implement previous method to store the new dark mode
        // preference for the authenticated user. Usually this preference will
        // be stored on a database, it is your task to store it.
    }


    
}
