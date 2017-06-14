<?php

namespace App\Providers;

use Carbon\Carbon;
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
        Carbon::setLocale('zh');

//        if (isset($_SERVER['HTTP_HOST'])) {
//            $wx = array(
//                'title' => config("app.name"),
//                'desc' => 'Jormin 的博客',
//                'link' => 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
//                'imgUrl' => 'https://'.config('filesystems.disks.qiniu.domain').'/logo.png'
//            );
//            View::share('wx',$wx);
//            $app = app('wechat');
//            $wechatjs = $app->js;
//            View::share('wechatjs',$wechatjs);
//        }
    }

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
