<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Jenssegers\Date\Date;

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

        Date::setlocale(config('app.locale'));

        $data['ip'] = \Request::ip();
        $data['userAgent'] = \Request::userAgent();

        $visitor = new Visitor();
        $result = $visitor->saveVisitor($data);


    }
}
