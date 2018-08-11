<?php


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

$router->post('/users', 'AuthenticationController@newUser');

$router->group(['prefix' => 'api'], function() use($router){
    

    $router->post('/login', 'AuthenticationController@login');
    
    $router->group(['middleware' => ['auth', 'token-expired']], function() use ($router){
        $router->get('/user-auth', 'AuthenticationController@userAuth');
    });

    $router->post('/refresh-token', ['middleware' => 'auth', 'AuthenticationController@refreshToken']);
   
});

$router->get('clientes', 'ClientesController@index');
$router->post('clientes', 'ClientesController@store');
$router->get('clientes/{id}', 'ClientesController@details');



$router->get('produtos', 'ProdutosController@index');
$router->post('produtos', 'ProdutosController@store');
$router->get('produtos/{id}', 'ProdutosController@details');


$router->get('orcamentos', 'OrcamentosController@index');
$router->post('orcamentos', 'OrcamentosController@store');
$router->get('orcamento/Detail/{id}', 'OrcamentosController@orcamentoDetail');


$router->get('vendas', 'VendasController@index');
$router->post('vendas', 'VendasController@store');
