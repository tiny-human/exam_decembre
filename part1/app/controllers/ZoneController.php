<?php 
namespace app\controllers;

use app\models\Livreur;
use app\models\Zone;
use Flight;

 class ZoneController
{
   public function addZone(){
    $nom = $_POST['nom'];
   $pourcentagestr = $_POST['pourcentage'];
   $pourcentage = floatval($pourcentagestr);
    $zone = new Zone(Flight::db());
    $zone->addZone($nom,$pourcentage);
    echo "zone ajoutee avec succes";
   }
    public function modifyZone(){
   $nom = $_POST['nom'];
   $pourcentagestr = $_POST['pourcentage'];
   $pourcentage = floatval($pourcentagestr);
   $id = $_POST['id_zone'];
    $zone = new Zone(Flight::db());
    $zone->modifierZone($nom,$pourcentage,$id);
    echo "zone modifier avec succes";
   }
    public function deleteZone(){
   $id = (int)($_POST['id_zone'] ?? 0);
    $zone = new Zone(Flight::db());
    $zone->supprimerZone($id);
    echo "OK";
   }
    public function getZoneById($id){
    $zone = new Zone(Flight::db());
    return $zone->getZonesParId($id);
   }
}
?>