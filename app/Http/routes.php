<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

$router->get('/', 'Frontend\HomeController@getIndex');
$router->controller('home', 'Frontend\HomeController', [
    'getSearch'  => 'frontend.search',
    'getProfile'  => 'frontend.profile',
    'getOrganization'  => 'frontend.organization',
    'getOfficer'  => 'frontend.officer',
]);

//BACKEND
$router->group(['prefix' => 'backend', 'namespace' => 'Backend'], function($router){

    $router->resource('officers', 'OfficerController');

    $router->resource('cases', 'CaseController');
    $router->get('cases/checklist/{caseId}/{checklistId}', ['as' => 'backend.cases.checklist', 'uses' => 'CaseController@getChecklist']);
    $router->post('cases/checklist/{caseId}/{checklistId}', ['as' => 'backend.cases.checklist', 'uses' => 'CaseController@postChecklist']);

    $router->post('cases/{caseId}/activities', ['as' => 'backend.cases.activity', 'uses' => 'CaseController@postActivity']);

    $router->get('dashboard/index', ['as' => 'dashboard.index', 'uses' => 'DashboardController@getIndex']);
    $router->get('setting/index', ['as' => 'setting.index', 'uses' => 'SettingController@getIndex']);

});

// GLOBAL ROUTE
$router->get('login', 'SiteController@getLogin');
$router->post('login', 'SiteController@postLogin');
$router->get('logout', 'SiteController@getLogout');

$router->get('kasus', 'HomeController@index');
$router->get('statistik', 'HomeController@statistic');

/*
|--------------------------------------------------------------------------
| Authentication & Password Reset Controllers
|--------------------------------------------------------------------------
|
| These two controllers handle the authentication of the users of your
| application, as well as the functions necessary for resetting the
| passwords for your users. You may modify or remove these files.
|
*/

//$router->controller('auth', 'AuthController');

//$router->controller('password', 'PasswordController');
