<?php

use app\controllers\LivraisonController;
use app\controllers\LivreurController;
use app\controllers\Util;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

$router->group('', function(Router $router) use ($app) {

    // Redirection
    $router->get('/', function() {
        Flight::redirect('/liste');
    });

    // Test
    $router->get('/hello-world/@name', function($name) {
        echo '<h1>Hello world '.$name.'</h1>';
    });

    $router->get('/test', function () {
        $db = Flight::db();
        var_dump($db->query("SELECT version()")->fetch());
    });

  
    $livraisonController = new LivraisonController();
    $utilController = new Util();
    $livreurController = new LivreurController();


    $router->get('/liste', [$livraisonController, 'getLivraison']);
    $router->get('/benef', [$livraisonController, 'getBenef']);
    $router->post('/benef', [$livraisonController, 'getBenef']);

    $router->get('/form', function() use ($app, $utilController, $livreurController) {
        $app->render('form', [
            'colis' => $utilController->getColis(),
            'statut' => $utilController->getStatut(),
            'zone' => $utilController->getZone(),
            'vehicule' => $utilController->getVehicule(),
            'livreur' => $livreurController->getLivreur()
        ]);
    });

    $router->get('/form_modification/@id', function($id) use ($app, $livraisonController, $utilController, $livreurController) {
        $app->render('form_modif', [
            'colis' => $utilController->getColis(),
            'statut' => $utilController->getStatut(),
            'zone' => $utilController->getZone(),
            'vehicule' => $utilController->getVehicule(),
            'livreur' => $livreurController->getLivreur(),
            'liste' => $livraisonController->getLivraisonParId($id),
			'id' => $id
        ]);
    });

    $router->post('/insert_livraison', function () use ($livraisonController) {
        $livraisonController->insererLivraison();
    });
	$router->post('/modifier_livraison', function () use ($livraisonController) {
        $livraisonController->modifierLivraison();
    });

}, [ SecurityHeadersMiddleware::class ]);
