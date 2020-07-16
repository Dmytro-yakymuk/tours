<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Language;
use App\Specie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function showLoginForm()
    {
        $menu = 'login';
        $languages = Language::all();
        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get();

        return view('auth.login')->with([
            'languages' => $languages,
            'menu' => $menu,
            'species' => $species
            ]);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    protected function redirectTo()
    {
        if(session('language') == 'ua') {
            return '/ua/admin';
        }
    }
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
