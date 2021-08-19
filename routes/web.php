<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AutenticacaoMiddleware;

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

Route::get('/', function () {  return view('welcome'); })->name('welcome');

Route::get('/welcome', function () {  return view('welcome'); });
Route::get('/login/{erro?}', 'App\Http\Controllers\LoginController@index')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@autenticar')->name('login');
Route::get('/sair', 'App\Http\Controllers\LoginController@sair')->name('sair');

// grupo de rotas 
Route::middleware('App\Http\Middleware\AutenticacaoMiddleware')->group(function(){
    Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin');
    Route::get('/produto', 'App\Http\Controllers\ProdutoController@index')->name('produto');
    Route::get('/mecanico{msg?}', 'App\Http\Controllers\MecanicoController@index')->name('mecanico');
        Route::post('/mecanico',  'App\Http\Controllers\MecanicoController@listar')->name('listar_mecanico');
        Route::post('/mecanico/adicionar',  'App\Http\Controllers\MecanicoController@adicionar')->name('add_mecanico');
        Route::get('/mecanico/adicionar',  'App\Http\Controllers\MecanicoController@adicionar')->name('add_mecanico');
        Route::get('/mecanico/excluir/{id}',  'App\Http\Controllers\MecanicoController@excluir')->name('exclui_mecanico');
        Route::get('/mecanico/alterar/{id}',  'App\Http\Controllers\MecanicoController@alterar')->name('altera_mecanico');

// Veiculo
Route::resource('veiculo', 'App\Http\Controllers\VeiculoController');
Route::post('/veiculo/listar', 'App\Http\Controllers\VeiculoController@listar')->name("listar_veiculo");

// Cliente
Route::resource('cliente', 'App\Http\Controllers\ClienteController');
Route::post('/adicionar_veiculo/{cliente_id}',  'App\Http\Controllers\ClienteController@adicionarVeiculo')->name("adicionar_veiculo");
Route::get('/retirar_veiculo/{veiculo_id}',  'App\Http\Controllers\ClienteController@retirarVeiculo')->name("retirar_veiculo");
Route::post('/pesquisa_cliente',  'App\Http\Controllers\ClienteController@pesquisa')->name("pesquisa_cliente");

// Ordem de Serviços
Route::resource('ordemservico', 'App\Http\Controllers\OrdemServicoController');
Route::get('/search',  'App\Http\Controllers\OrdemServicoController@search')->name("os_search");
Route::post('/validar',  'App\Http\Controllers\OrdemServicoController@validar')->name("os_validar");
Route::post('/update_mo',  'App\Http\Controllers\OrdemServicoController@update_mo')->name("update_mo");
Route::post('/store/{ordemservico}',  'App\Http\Controllers\OrdemServicoController@store')->name("store");
Route::get('/imprimir/{id}', 'App\Http\Controllers\OrdemServicoController@imprimir')->name("imprimir_pdf");
Route::post('/pesquisa',  'App\Http\Controllers\OrdemServicoController@pesquisa')->name("pesquisa");

// Produto
Route::resource('produto', 'App\Http\Controllers\ProdutoController');
Route::post('produto/store/{ordemservico}', 'App\Http\Controllers\ProdutoController@store')->name("produto.store");
Route::delete('produto/exclui_produto/{ordemservico}',  'App\Http\Controllers\ProdutoController@exclui_produto')->name("exclui_produto");


});
