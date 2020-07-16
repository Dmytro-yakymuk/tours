<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('tours/{cat_tour}', 'Api\ToursController@orderBy');
//Route::get('tours/{cat_tour?}', ['uses'=>'Api\ToursController@index', 'as'=>'tourCat' ])->where('cat_tour', '[\w-]+');


Route::resource('languages', 'Api\ToursController');



// -------------------- Jquery ------------------------ //

// ======== INDEX ==========

Route::post('event_reserve', 'ToursController@event_reserve');
Route::post('email_subscription', 'ToursController@email_subscription');



// ======== ADMIN ==========


// Image Upload
Route::post('images_view/{id}', 'Admin\ToursController@images_view');
Route::post('images_upload/{id}', 'Admin\ToursController@images_upload');
Route::post('image_destroy', 'Admin\ToursController@image_destroy');
Route::post('images_destroy', 'Admin\ToursController@images_destroy');


// Tour Create
Route::post('store', 'Admin\ToursController@store');
Route::post('store2', 'Admin\ToursController@store2');

// Icons Create Update Room Public Delete
Route::post('icon_store', 'Admin\IconsController@store');
Route::post('icon_update/{id}', 'Admin\IconsController@update');
Route::post('icon_room', 'Admin\IconsController@room');
Route::post('icon_public', 'Admin\IconsController@public');
Route::post('icon_delete/{id}', 'Admin\IconsController@destroy');

// Sevice Create Update Public Delete
Route::post('service_store', 'Admin\ServicesController@store');
Route::post('service_update/{id}', 'Admin\ServicesController@update');
Route::post('service_public', 'Admin\ServicesController@public');
Route::post('service_delete/{id}', 'Admin\ServicesController@destroy');


// Specie Create Update Public Delete
Route::post('specie_store', 'Admin\SpeciesController@store');
Route::post('specie_update/{specie}', 'Admin\SpeciesController@update');
Route::post('specie_public', 'Admin\SpeciesController@public');
Route::post('specie_delete/{id}', 'Admin\SpeciesController@destroy');


// Category Create Update Public Delete
Route::post('category_store', 'Admin\CategoriesController@store');
Route::post('category_update/{category}', 'Admin\CategoriesController@update');
Route::post('category_public', 'Admin\CategoriesController@public');
Route::post('category_delete/{id}', 'Admin\CategoriesController@destroy');

// Country Create Update Delete
Route::post('country_store', 'Admin\CountriesController@store');
Route::post('country_update/{country}', 'Admin\CountriesController@update');
Route::post('country_delete/{id}', 'Admin\CountriesController@destroy');

// Region Create Update Public Delete
Route::post('region_store', 'Admin\RegionsController@store');
Route::post('region_update/{region}', 'Admin\RegionsController@update');
Route::post('region_public', 'Admin\RegionsController@public');
Route::post('region_delete/{id}', 'Admin\RegionsController@destroy');



// Role Create Update Delete
Route::post('role_store', 'Admin\RolesController@store');
Route::post('role_update/{id}', 'Admin\RolesController@update');
Route::post('role_delete/{id}', 'Admin\RolesController@destroy');

// Permission Create Update Delete     
Route::post('permission_store', 'Admin\PermissionsController@store');
Route::post('permission_update/{id}', 'Admin\PermissionsController@update');
Route::post('permission_delete/{id}', 'Admin\PermissionsController@destroy');

// Permissions & Roles Public
Route::post('permissions_roles_public', 'Admin\PermissionsRolesController@public');

// Roles & Users Public
Route::post('roles_users_public', 'Admin\RolesUsersController@public');

// Users Update Delete     
Route::post('user_update/{id}', 'Admin\UsersController@update');
Route::post('user_delete/{id}', 'Admin\UsersController@destroy');

// Event Create Update Public Delete
Route::post('event_store', 'Admin\EventsController@store');
Route::post('event_update/{id}', 'Admin\EventsController@update');
Route::post('event_public', 'Admin\EventsController@public');
Route::post('event_delete/{id}', 'Admin\EventsController@destroy');

// Comments View Create Update Public Delete
Route::post('view_comment_plus', 'Admin\CommentsController@view_comment_plus');
Route::post('comment_store', 'Admin\CommentsController@store');
Route::post('comment_update/{id}', 'Admin\CommentsController@update');
Route::post('comment_public', 'Admin\CommentsController@public');
Route::post('comment_delete/{id}', 'Admin\CommentsController@destroy');

// Comments_Plus Create Update Public Delete
Route::post('comment_plus_store', 'Admin\CommentPlusController@store');
Route::post('comment_plus_update/{id}', 'Admin\CommentPlusController@update');
Route::post('comment_plus_public', 'Admin\CommentPlusController@public');
Route::post('comment_plus_delete/{id}', 'Admin\CommentPlusController@destroy');



// -------------------- End Jquery ------------------------ //