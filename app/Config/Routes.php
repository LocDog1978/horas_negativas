<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*** ---------- Login/Logout ---------- ***/
$routes->group('login', function($routes) {
	$routes->get('/', 'LoginController::index');
	$routes->post('signIn', 'LoginController::signIn');
	$routes->get('signOut', 'LoginController::signOut');
});

// horas negativas
//$routes->get('cad_negativas', 'HorasNegativasController');

$routes->group('cad_negativas', function($routes) {
	$routes->get('/', 'HorasNegativasController');
	$routes->post('validate', 'HorasNegativasController::horasValidate');
	$routes->post('tabelaHorasNegativas', 'HorasNegativasController::tabelaHorasNegativas');
	$routes->post('getHorasNegativas', 'HorasNegativasController::getHorasNegativas');
});

/* Home route */
$routes->get('/', 'HomeController::index');
$routes->post('/tabela', 'HomeController::tabela');


/*** ---------- Miscellaneous ---------- ***/
/* datatables assets */
$routes->get('assets/datatables/traducao', 'Assets\DatatablesController::traducao');
// $routes->get('assets/js/libs/DataTables-1.12.1/traducao', 'Assets\DatatablesController::traducao');
/* error */
$routes->get('error/e403', 'ErrorController::e403');
/* relatório */
$routes->get('relatorio', 'RelatorioController');
// $routes->get('relatorio', 'RelatorioController::relatorio');

/*** ---------- Cadastro usuários ---------- ***/
$routes->group('cadastro', ['filter' => 'updateOwnUser'], function($routes) {
	$routes->get('usuarios', 'Cadastro\Usuarios\CadastroUsuariosController::index');
	$routes->post('usuarios/(:num)', 'Cadastro\Usuarios\CadastroUsuariosController::index/$1');
	$routes->get('usuarios/table', 'Cadastro\Usuarios\CadastroUsuariosController::table');
	$routes->get('usuarios/add', 'Cadastro\Usuarios\CadastroUsuariosController::add');
	$routes->post('usuarios/validation', 'Cadastro\Usuarios\CadastroUsuariosController::validation');
	$routes->post('usuarios/store', 'Cadastro\Usuarios\CadastroUsuariosController::store');
	$routes->get('usuarios/update/(:num)', 'Cadastro\Usuarios\CadastroUsuariosController::update/$1');
	$routes->post('usuarios/update/(:num)', 'Cadastro\Usuarios\CadastroUsuariosController::update/$1');
	$routes->post('usuarios/updateID', 'Cadastro\Usuarios\CadastroUsuariosController::updateID');
	$routes->get('usuarios/trash/(:num)', 'Cadastro\Usuarios\CadastroUsuariosController::trash/$1');
	$routes->get('usuarios/restore/(:num)', 'Cadastro\Usuarios\CadastroUsuariosController::restore/$1');
	$routes->get('usuarios/delete/(:num)', 'Cadastro\Usuarios\CadastroUsuariosController::delete/$1');
});

/*** ---------- Cadastro postos ---------- ***/
$routes->group('cadastro', ['filter' => 'nivel'], function($routes) {
    $routes->get('postos', 'Cadastro\PostosController::postos');
    $routes->get('postos/trash/(:num)', 'Cadastro\PostosController::trash/$1');
    $routes->get('postos/restore/(:num)', 'Cadastro\PostosController::restore/$1');
    $routes->get('postos/add', 'Cadastro\PostosController::postos');
    $routes->get('postos/edit/(:num)', 'Cadastro\PostosController::postos/$1');
    $routes->get('postos/success/(:num)', 'Cadastro\PostosController::postos/$1');
    $routes->post('postos/insert', 'Cadastro\PostosController::postos');
    $routes->post('postos/insert_validation', 'Cadastro\PostosController::postos');
    $routes->post('postos/update/(:num)', 'Cadastro\PostosController::postos/$1');
    $routes->post('postos/update_validation/(:num)', 'Cadastro\PostosController::postos/$1');
    $routes->post('postos/ajax_list', 'Cadastro\PostosController::postos');
    $routes->post('postos/ajax_list_info', 'Cadastro\PostosController::postos');
});
$routes->group('cadastro', ['filter' => 'nivel_delete'], function($routes) {
    $routes->get('fases_da_obra/delete/(:num)', 'Cadastro\FasesDaObraController::fases_da_obra/$1');
});

/*** ---------- Cadastro logs_alteracoes ---------- ***/
$routes->group('cadastro', ['filter' => 'nivel'], function($routes) {
	$routes->get('logs_alteracoes', 'Cadastro\LogAlteracoesController::log_alteracoes');
	$routes->get('logs_alteracoes/trash/(:num)', 'Cadastro\LogAlteracoesController::trash/$1');
	$routes->get('logs_alteracoes/restore/(:num)', 'Cadastro\LogAlteracoesController::restore/$1');
	$routes->get('logs_alteracoes/add', 'Cadastro\LogAlteracoesController::log_alteracoes');
	$routes->get('logs_alteracoes/edit/(:num)', 'Cadastro\LogAlteracoesController::log_alteracoes/$1');
	$routes->get('logs_alteracoes/success/(:num)', 'Cadastro\LogAlteracoesController::log_alteracoes/$1');
	$routes->post('logs_alteracoes/insert', 'Cadastro\LogAlteracoesController::log_alteracoes');
	$routes->post('logs_alteracoes/insert_validation', 'Cadastro\LogAlteracoesController::log_alteracoes');
	$routes->post('logs_alteracoes/update/(:num)', 'Cadastro\LogAlteracoesController::log_alteracoes/$1');
	$routes->post('logs_alteracoes/update_validation/(:num)', 'Cadastro\LogAlteracoesController::log_alteracoes/$1');
	$routes->post('logs_alteracoes/ajax_list', 'Cadastro\LogAlteracoesController::log_alteracoes');
	$routes->post('logs_alteracoes/ajax_list_info', 'Cadastro\LogAlteracoesController::log_alteracoes');
});
$routes->group('cadastro', ['filter' => 'nivel_delete'], function($routes) {
	$routes->get('logs_alteracoes/delete/(:num)', 'Cadastro\LogAlteracoesController::log_alteracoes/$1');
});


/***--------------- cadastro postos ------------------***/

