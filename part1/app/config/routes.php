<?php

use app\controllers\ApiExampleController;
use app\controllers\LivraisonController;
use app\controllers\LivreurController;
use app\controllers\PanneController;
use app\controllers\TrajetController;
use app\controllers\Util;
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
		Flight::redirect('/liste');
		
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

	$router->get('/liste', [$controller, 'getLivraison']);
	$router->get('/benef', [$controller, 'getBenef']);
	$router->post('/benef', [$controller, 'getBenef']);

	$router->get('/form', function() use ($app, $controller) {
    $controller = new Util();
    $controller_livraison = new LivreurController();
    
    $liste_colis = $controller->getColis();
    $liste_statut = $controller->getStatut();
    $liste_zone = $controller->getZone();
    $liste_vehicule = $controller->getVehicule();
    $liste_livreur = $controller_livraison->getLivreur();
    $app->render('form', [
        'colis' => $liste_colis,
        'statut' => $liste_statut,
        'zone' => $liste_zone,
        'vehicule' => $liste_vehicule,
        'livreur' => $liste_livreur
		]);
	});

	$router->post('/insert_livraison',function () use ($controller){
		$controller =  new LivraisonController();
		$controller->insererLivraison();
	});
	
}, [ SecurityHeadersMiddleware::class ]);