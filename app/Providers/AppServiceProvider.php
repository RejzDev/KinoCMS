<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Jenssegers\Date\Date;
use App\Models\MainPage;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Facades\Agent;

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
        $data['browser'] = Agent::browser();


        $visitor = new Visitor();
        $result = $visitor->saveVisitor($data);

        $mainPage =  new MainPage();
        $mainData =  $mainPage->getPage();
        View::share(['mainData' =>  $mainData]);


    }
}
