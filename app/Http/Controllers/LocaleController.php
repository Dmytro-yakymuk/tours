<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Middleware\LocaleMiddleware;
use Redirect;

class LocaleController extends Controller
{

    public function setlocale($lang)
    {
        
        $referer = Redirect::back()->getTargetUrl();; //URL предыдущей страницы повністю
        $parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы без домену

        //разбиваем на массив по разделителю
        $segments = explode('/', $parse_url);
        
        
        //Если URL (где нажали на переключение языка) содержал корректную метку языка
        if (in_array($segments[1], LocaleMiddleware::$languages)) {
            unset($segments[1]); //удаляем метку
        } 
        
        //Добавляем метку языка в URL (если выбран не язык по-умолчанию)
        session()->put('language', $lang); 
        array_splice($segments, 1, 0, session('language')); 
        
        //формируем полный URL
        $url = Request::root().implode("/", $segments);

        //если были еще GET-параметры - добавляем их
        if(parse_url($referer, PHP_URL_QUERY)){
            $url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
        }
        return redirect($url); //Перенаправляем назад на ту же страницу  
    }
}
