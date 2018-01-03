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

Auth::routes();

Route::get('/lista', 'ProdutoController@lista');
Route::get('/produtos/mostra/{id}', 'ProdutoController@mostra')->where('id', '[0-9]+'); // estou dizendo no where, que somente faz a roda se o id for numero
Route::get('/produtos/novo', 'ProdutoController@novo');
Route::post('/produtos/adiciona', 'ProdutoController@adiciona');
Route::post('/produtos/altera/{id}', 'ProdutoController@altera');
Route::get('/produtos/remove/{id}', 'ProdutoController@remove');

Route::get('/', 'HomeController@index')->name('home');
