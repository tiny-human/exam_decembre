<?php 
namespace app\controllers;

use app\models\Livraison;
use Flight;

 class LivraisonController
{
    // public function getLivraison(){
    //     $db = Flight::db();
    //     $Livraison = new Livraison($db);
    //     $liste = $Livraison ->getLivraison();

    //     Flight::render('liste',['liste' => $liste]);
    // }
    
    // public function getBenefMois() {
    //     $db = Flight::db();
    //     $Livraison = new Livraison($db);
    //     $benef = $Livraison ->getBeneficeParMois();     

    //     Flight::render('benef',['benefMois' => $benef]);
    // }

    // public function getBenefJour(){
    //     $db = Flight::db();
    //     $Livraison = new Livraison($db);
    //     $benef = $Livraison ->getBeneficeParJour();      

    //     Flight::render('benef',['benefJour' => $benef]);
    // }

    // public function getBenefAnnee(){
    //     $db = Flight::db();
    //     $Livraison = new Livraison($db);
    //     $data = $Livraison ->getBeneficeParAnnee();      

    //     Flight::render('benef',['BenefAnnee' => $data]);
    // }

    public function getCoutRevient(){
        $db = Flight::db();
        $Livraison = new Livraison($db);
        $data = $Livraison->getCoutRevient();
        return $data;
    }

    public function insererLivraison(){
        $db = Flight::db();
        $date = $_POST['date_livraison'] ;
        $id_vehicule = $_POST['id_vehicule'];
        $id_livreur = $_POST['id_livreur'];
        $id_colis = $_POST['id_colis'] ?? '';
        $addresse_depart = $_POST['adresse_depart'] ;
        $zone = $_POST['id_zone'] ;
        $statut = $_POST['id_statut'] ;
        $cout_vehicule = $_POST['cout_vehicule'];
        $livraison = new Livraison($db);
        $livraison->insertLivraison($date,$id_vehicule,$id_livreur,$id_colis,$addresse_depart,$zone,$statut,$cout_vehicule);
    }

}

?>