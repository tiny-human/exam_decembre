<?php 
namespace app\controllers;

use app\models\Colis;
use app\models\Statut;
use app\models\Vehicule;
use app\models\Zone;
use Flight;

class Util{
    public function getColis() {
        $colis = new Colis(Flight::db());
        return $liste_colis = $colis->getColis();
    }
      public function getStatut() {
        $statut = new Statut(Flight::db());
        return $liste_statut = $statut->getStatut();
    }
        public function getZone() {
        $zone = new Zone(Flight::db());
        return $liste_zone = $zone->getZones();
    }
        public function getVehicule() {
        $vehicule = new Vehicule(Flight::db());
        return $liste_zone = $vehicule->getVehicules();
    }
}


?>