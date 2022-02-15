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

/**
 * Product routes
 */
$router->group(['prefix' => 'products'], function () use ($router) {
    $router->get('/',  ['uses' => 'ProductController@getAllProducts']);

    $router->get('/{id}', ['uses' => 'ProductController@getProduct']);

    $router->post('/', ['uses' => 'ProductController@postProduct']);

    $router->put('/{id}', ['uses' => 'ProductController@putProduct']);

    $router->delete('/{id}', ['uses' => 'ProductController@deleteProduct']);
});

/**
 * Category routes
 */
$router->group(['prefix' => 'categories'], function () use ($router) {
    $router->get('/',  ['uses' => 'CategoryController@getAllCategories']);

    $router->get('/{id}/products', ['uses' => 'CategoryController@getCategoryProducts']);

    $router->post('/', ['uses' => 'CategoryController@postCategory']);

    $router->put('/{id}', ['uses' => 'CategoryController@putCategory']);

    $router->delete('/{id}', ['uses' => 'CategoryController@deleteCategory']);
});



