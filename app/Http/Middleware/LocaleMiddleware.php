<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Request;

class LocaleMiddleware
{
    public static $mainLanguage = 'ua'; //основной язык, который не должен отображаться в URl
    public static $languages = ['en', 'ru', 'ua'];

    public static function getLocale()
    {
        $uri = Request::path(); //получаем URI 

        $segmentsURI = explode('/',$uri); //делим на части по разделителю "/"

        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {
            session()->put('language', $segmentsURI[0]); 
            return $segmentsURI[0];
        } else {
            return  self::$mainLanguage; 
        }
    }


    public function handle($request, Closure $next)
    {
        $locale = self::getLocale();
        if($locale) App::setLocale($locale); 

        return $next($request); //пропускаем дальше - передаем в следующий посредник
    }
}
