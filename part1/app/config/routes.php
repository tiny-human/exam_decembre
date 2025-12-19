<?php
use app\controllers\LivraisonController;
use app\controllers\LivreurController;
use app\controllers\Util;
use app\controllers\ZoneController;
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
	$zoneController = new ZoneController();


    $router->get('/liste', [$livraisonController, 'getLivraison']);
    $router->get('/benef', [$livraisonController, 'getBenef']);
	$router->get('/form_ajout_zone', function() use($app){
		$app->render('ajout_zone');
	});
	$router->get('/deleteAll', function() use($app){
		$app->render('delete');
	});

    $router->post('/benef', [$livraisonController, 'getBenef']);
	$router->get('/zone', function() use ($app,$utilController){
		$zone = $utilController->getZone();
		$app->render('zone',['zone'=>$zone]);
	});

    $router->get('/form', function() use ($app, $utilController, $livreurController) {
        $app->render('form', [
            'colis' => $utilController->getColis(),
            'statut' => $utilController->getStatut(),
            'zone' => $utilController->getZone(),
            'vehicule' => $utilController->getVehicule(),
            'livreur' => $livreurController->getLivreur()
        ]);
    });
	$router->get('/form_zone/@id', function($id) use ($app,$zoneController) {
        $app->render('form_zone', [
            'zone'=> $zoneController->getZoneById($id),
			'id' => $id
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
	$router->post('/modifier_zone', function () use ($zoneController) {
        $zoneController->modifyZone();
    });
	$router->post('/ajout_zone', function () use ($zoneController) {
        $zoneController->addZone();
    });
		$router->post('/supprimer_zone', function () use ($zoneController) {
        $zoneController->deleteZone();
    });
	$router->post('/deleteTOUT', function () use ($livraisonController, $zoneController) {
        $livraisonController->deleteAll();
		Flight::redirect('/liste');
    });
}, [ SecurityHeadersMiddleware::class ]);
