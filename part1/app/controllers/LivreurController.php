<?php 
namespace app\controllers;

use app\models\Livreur;

use Flight;

 class LivreurController
{
   public function getLivreur(){
    $livreur = new Livreur(Flight::db());
    $liste = $livreur->getLivreur();

   Flight :: render('liste',['livreur' => $liste]);
   }
}


?>