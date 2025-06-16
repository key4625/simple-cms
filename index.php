<?php
/**
 * Simple CMS - Un sistema di gestione contenuti semplice
 * 
 * @copyright Copyright (c) 2025
 * @license http://creativecommons.org/licenses/by/4.0/ Creative Commons Attribution 4.0
 */

require_once __DIR__ . '/vendor/autoload.php';

use SimpleCMS\Router;
use SimpleCMS\Controllers\BackendController;

// Abilita la visualizzazione degli errori per il debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$router = new Router();

// Definizione delle rotte frontend
$router->get('/', 'FrontendController@index');
$router->get('/article/:id', 'FrontendController@article');
$router->get('/category/:id', 'FrontendController@category');
$router->get('/license', 'FrontendController@license');

// Definizione delle rotte di autenticazione
$router->get('/login', [BackendController::class, 'login']);
$router->post('/authenticate', [BackendController::class, 'authenticate']);
$router->get('/admin/logout', 'BackendController@logout');

// Definizione delle rotte del backend
$router->get('/admin', 'BackendController@login');
$router->post('/admin/login', 'BackendController@authenticate');
$router->get('/admin/dashboard', 'BackendController@dashboard');

// Rotte per la gestione articoli
$router->get('/admin/articles', 'BackendController@articles');
$router->get('/admin/articles/new', 'BackendController@newArticle');
$router->post('/admin/articles/create', 'BackendController@createArticle');
$router->get('/admin/articles/edit/:id', 'BackendController@editArticle');
$router->post('/admin/articles/update/:id', 'BackendController@updateArticle');
$router->get('/admin/articles/delete/:id', 'BackendController@deleteArticle');

// Rotte per la gestione categorie
$router->get('/admin/categories', 'BackendController@categories');
$router->get('/admin/categories/new', 'BackendController@newCategory');
$router->post('/admin/categories/create', 'BackendController@createCategory');
$router->get('/admin/categories/edit/:id', 'BackendController@editCategory');
$router->post('/admin/categories/update/:id', 'BackendController@updateCategory');
$router->get('/admin/categories/delete/:id', 'BackendController@deleteCategory');

// Aggiunta di un controllo per correggere i percorsi
$_SERVER['REQUEST_URI'] = str_replace('/simple-cms', '', $_SERVER['REQUEST_URI']);

$router->dispatch();