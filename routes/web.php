<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/auth','AuthController@authenticate');


$router->group(['prefix' => 'user'], function () use ($router) {
    $router->get('/','UserController@index');
    $router->get('/{id}','UserController@show');
    $router->post('/','UserController@store');
    $router->put('/{id}','UserController@update');
    $router->delete('/{id}','UserController@destroy');
});

$router->group(['prefix' => 'board'], function () use ($router) {
    $router->get('/','BoardController@index');
    $router->get('/user/{id}','BoardController@indexByUser');
    $router->get('/{id}','BoardController@show');
    $router->post('/','BoardController@store');
    $router->put('/{id}','BoardController@update');
    $router->delete('/{id}','BoardController@destroy');
});

$router->group(['prefix' => 'task'], function () use ($router) {
    $router->get('/','TaskController@index');
    $router->get('/{id}','TaskController@show');
    $router->post('/','TaskController@store');
    $router->put('/{id}','TaskController@update');
    $router->delete('/{id}','TaskController@destroy');
});




