<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(session('language')){
        return redirect('/'. session('language'));
    } else {
        return redirect('/'. App\Http\Middleware\LocaleMiddleware::$mainLanguage);
    }
    
});

Route::get('swap', ['uses'=>'SwapController@swap']);

      

Route::group(['prefix' => App\Http\Middleware\LocaleMiddleware::getLocale()], function(){
     
    
    
    Route::get('/', 'IndexController@index')->name('main');
                    
    Route::get('tours/{cat_tour}', ['uses'=>'ToursController@index', 'as'=>'tours.index' ])->where('cat_tour', '[\w-]+');
    Route::get('tours/{cat_tour}/{slug}', ['uses'=>'ToursController@show', 'as'=>'tours.show' ]);

    Route::get('contacts', ['uses' => 'ContactsController@index', 'as' => 'contacts.index']);




    Auth::routes();
    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
        
        Route::get('/', ['uses' => 'Admin\IndexController@index', 'as' => 'home']);

        Route::get('tours/{specie}', ['uses'=>'Admin\ToursController@index', 'as'=>'admin.tours.index' ]);
        Route::get('tours/{specie}/create', ['uses'=>'Admin\ToursController@create', 'as'=>'admin.tours.create' ]);
        Route::get('tours/{specie}/{slug}/edit', ['uses'=>'Admin\ToursController@edit', 'as'=>'admin.tours.edit' ]);
        Route::post('tours/{specie}/{slug}', ['uses'=>'Admin\ToursController@update', 'as'=>'admin.tours.update' ]);
        Route::post('tours/{id}', ['uses'=>'Admin\ToursController@destroy', 'as'=>'admin.tours.destroy' ]);

        Route::get('icons', ['uses'=>'Admin\IconsController@index', 'as'=>'admin.icons.index' ]);
        Route::get('services', ['uses'=>'Admin\ServicesController@index', 'as'=>'admin.services.index' ]);

        Route::get('comments', ['uses'=>'Admin\CommentsController@index', 'as'=>'admin.comments.index' ]);
        Route::get('comment_plus', ['uses'=>'Admin\CommentPlusController@index', 'as'=>'admin.comment_plus.index' ]);
        
        Route::get('species', ['uses'=>'Admin\SpeciesController@index', 'as'=>'admin.spesies.index' ]);
        Route::get('categories', ['uses'=>'Admin\CategoriesController@index', 'as'=>'admin.categories.index' ]);

        Route::get('roles', ['uses'=>'Admin\RolesController@index', 'as'=>'admin.roles.index' ]);
        Route::get('permissions', ['uses'=>'Admin\PermissionsController@index', 'as'=>'admin.permissions.index' ]);
        Route::get('permissions_roles', ['uses'=>'Admin\PermissionsRolesController@index', 'as'=>'admin.permissions_roles.index' ]);
        Route::get('users', ['uses'=>'Admin\UsersController@index', 'as'=>'admin.users.index' ]);
        Route::get('roles_users', ['uses'=>'Admin\RolesUsersController@index', 'as'=>'admin.roles_users.index' ]);
        

        Route::get('countries', ['uses'=>'Admin\CountriesController@index', 'as'=>'admin.countries.index' ]);
        Route::get('regions', ['uses'=>'Admin\RegionsController@index', 'as'=>'admin.regions.index' ]);


        Route::get('events', ['uses'=>'Admin\EventsController@index', 'as'=>'admin.events.index' ]);




    //     Route::resource('users', 'Admin\UsersController', [
    //                         'parameters' => [
    //                             'users' => 'alias'
    //                         ]
    //                     ]);
    
    //     Route::get('articles/category/{cat_alias?}', ['uses'=>'Admin\ArticlesController@index', 'as'=>'adminArticlesCat' ])->where('cat_alias', '[\w-]+');
  
    });

    // Маршруты регистрации...
    // Route::post('register', 'Auth\RegisterController@register');
    // Route::get('register', ['uses' => 'Auth\RegisterController@showRegistrationForm', 'as' => 'register']);

    // Маршруты аутентификации...
    // Route::post('login', 'Auth\LoginController@login');
    // Route::get('login', ['uses' => 'Auth\LoginController@showLoginForm', 'as' => 'login']);
    // Route::post('logout', ['uses' => 'Auth\LoginController@logout', 'as' => 'logout']);

    // Route::post('password/email', ['uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail', 'as' => 'password.email']);
    // Route::get('password/reset', ['uses' => 'Auth\ForgotPasswordController@showLinkRequestForm', 'as' => 'password.request']);
    // Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    // Route::get('password/reset/{token}', ['uses' => 'Auth\ResetPasswordController@showResetForm', 'as' => 'password.reset']);

    // Route::post('ulogin', 'UloginController@login');



    Route::get('setlocale/{lang}', 'LocaleController@setlocale' )->name('setlocale');
});

