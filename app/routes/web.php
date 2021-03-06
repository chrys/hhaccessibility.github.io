<?php

use App\Location;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Route::get('our-vision', function()
{
    return View::make('pages.our_vision');
});
Route::get('terms-of-use', function()
{
    return View::make('pages.terms_of_use');
});
Route::get('privacy-policy', function()
{
    return View::make('pages.privacy_policy');
});
Route::get('password-recovery', function() {
    return View::make('pages.password_recovery');
});

Route::get('profile', 'ProfileController@index');
Route::post('profile', 'ProfileController@save');
Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@post');
Route::get('profile-photo-upload', 'ProfilePhotoUploadController@index');
Route::post('profile-photo-upload', 'ProfilePhotoUploadController@post');
Route::get('profile-photo', 'ProfilePhotoUploadController@photo');
Route::get('location-search', 'LocationSearchController@search');
Route::get('location-report/{location_id}', 'LocationReportController@show');
Route::get('location-report/{location_id}/{rating_system}', 'LocationReportController@show');
Route::get('location-report/{location_id}/{rating_system}/{question_category_id}', 'LocationReportController@show');
Route::get('contact', 'ContactController@index');
Route::post('contact', 'ContactController@sendMessage');
Route::get('signin', 'SignInController@showForm');
Route::post('signin', 'SignInController@authenticate');
Route::get('signout', 'SignInController@signout');

Route::get('fbauth/{auth?}', array('as'=>'facebookAuth', 'uses'=>'SocialAuthController@getFacebookLogin'));

Route::get('socialauth/auth/{provider}', 'SocialAuthController@getSocialLogin');
Route::get('socialauth/auth', 'SocialAuthController@getSocialLoginCallBack');

Route::get('signup', 'SignUpController@showForm');
Route::post('signup', 'SignUpController@createUser');

Route::get('api/locations', function (Request $request) {
	return Location::all();
});
