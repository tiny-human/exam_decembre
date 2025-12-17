<?php 
namespace app\controllers;

use app\models\Livraison;
use Flight;

 class LivraisonController
{
    public function getLivraison(){
        $db = Flight::db();
        $Livraison = new Livraison($db);
        $liste = $Livraison ->getLivraison();

        Flight::render('liste',['liste' => $liste]);
    }
    
    public function getBenefMois() {
        $db = Flight::db();
        $Livraison = new Livraison($db);
        $benef = $Livraison ->getBeneficeParMois();     

        Flight::render('benef',['benefMois' => $benef]);
    }

    public function getBenefJour(){
        $db = Flight::db();
        $Livraison = new Livraison($db);
        $benef = $Livraison ->getBeneficeParJour();      

        Flight::render('benef',['benefJour' => $benef]);
    }

    public function getBenefAnnee(){
        $db = Flight::db();
        $Livraison = new Livraison($db);
        $data = $Livraison ->getBeneficeParAnnee();      

        Flight::render('benef',['BenefAnnee' => $data]);
    }
}

?>