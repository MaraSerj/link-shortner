<?php
/**
 * @var \Illuminate\Routing\Router $router
 */

$router->get('/', 'HomeController@index')->name('index');

$router->auth();

$router->get('home', 'HomeController@home')->name('home');
$router->get('user', ['as' => 'user.get', 'uses' => 'HomeController@getAuthUser']);
$router->post('short-urls', 'ShortUrlController@store')->name('short-urls.store');
$router->get('{any}', 'ShortUrlController@show')->where('any', '.*')->name('redirect');

