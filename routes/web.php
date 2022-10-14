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
// $router->get('/fulk','DatailsController@fulks');
 $router->post('/registers','LoginController@register');
 $router->post('/login','LoginController@onlogin');
 $router->post('/insert',['middleware'=>'auth','uses'=>'phonebookController@oninsert']);
 $router->get('/select',['middleware'=>'auth','uses'=>'phonebookController@onselect']);
 $router->delete('/delete',['middleware'=>'auth','uses'=>'phonebookController@ondelete']);


