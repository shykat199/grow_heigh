<?php

namespace App\Providers;

use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        DB::enableQueryLog();

        if ($this->app->environment('production')){
            URL::forceScheme('https');
        }

        View::share('siteSettingData', getSettingsData([
            'site_logo',
            'site_favicon',
            'homepage_title',
            'homepage_subtitle',
            'about_us_title',
            'about_us_description',
            'about_us_short_description',
            'contact_email',
            'contact_number',
            'contact_fax',
            'facebook_link',
            'youtube_link',
            'twitter_link',
            'instagram_link',
            'linkedin_link',
            'location_address',
            'footer_short_description',
        ]));

        Paginator::useBootstrap();
    }
}
