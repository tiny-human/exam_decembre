<?php

use app\controllers\ApiExampleController;
use app\controllers\PanneController;
use app\controllers\TrajetController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {

	$router->get('/', function() use ($app) {
		$app->render('welcome', [ 'message' => 'You are gonna do great things!' ]);
	});

	$router->get('/hello-world/@name', function($name) {
		echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
	});

	$router->get('/test', function () {
		$db = Flight::db();
		$result = $db->query("SELECT version()")->fetch();
		var_dump($result);
	});

	$controller = new LivraisonController();
	$livreur = new LivreurController();

	$router->get('/liste', function () use($app, $controller) {
		$produit = $controller->getLivraison();
	});
	
	$router->group('/benef', function() use ($router, $controller) {
		$router->get('/mois', [$controller, 'getBenefMois'] );
		$router->get('/jour', [$controller, 'getBenefJour'] );
		$router->get('/annee', [$controller, 'getBenefAnnee'] );
	});

	$router->get('/form', function() use ($app){
		$app->render('form');
	});


	$router->group('/api', function() use ($router) {
		$router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
		$router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
		$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
	});
	
}, [ SecurityHeadersMiddleware::class ]);