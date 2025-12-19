<?php 
namespace app\controllers;

use DateTime;
use app\models\Livraison;
use app\models\Colis;
use Flight;

 class LivraisonController
{
    public function getLivraison() {
        $db = Flight::db();
        $Livraison = new Livraison($db);
        $Colis = new Colis($db);
        $liste   = $Livraison->getLivraison();        
        $cout    = $Livraison->getCoutRevient();     
        $recette = $Colis->getInfoColis();      
        Flight::render('liste', [
            'liste'   => $liste,
            'cout'    => $cout,
            'recette' => $recette
        ]);
    }

    public function getLivraisonParId($id) {
    $db = Flight::db();
    $Livraison = new Livraison($db);
    $liste   = $Livraison->getLivraisonParId($id);
    return $liste;
    }

    public function getBenef() {
        $db = Flight::db();
        $Livraison = new Livraison($db);
    
        $jour   = Flight::request()->data->jour ?? null;
        $mois   = Flight::request()->data->mois ?? null;
        $annee  = Flight::request()->data->annee ?? null;
    
        $benefices     = [];
        $titre         = "Bénéfices de la société";
        $typeAffiche   = "";
        $messageErreur = null;
    
        try {
            if (!empty($jour)) {
                $benefices = $Livraison->getBeneficeParJour($jour);
    
                $trouve = false;
                foreach ($benefices as $b) {
                    if ($b['jour'] == $jour) {
                        $trouve = true;
                        break;
                    }
                }
    
                if ($trouve) {
                    $titre = "Bénéfice du " . date('d/m/Y', strtotime($jour));
                    $typeAffiche = "jour";

                } else {
                    $benefices = [];
                    $messageErreur = "Aucun bénéfice trouvé pour le jour sélectionné : " . date('d/m/Y', strtotime($jour));
                    $typeAffiche = "jour"; 
                }
    
            } elseif (!empty($mois)) {
                $benefices = $Livraison->getBeneficeParMois($mois,$annee);
    
                $trouve = false;
                foreach ($benefices as $b) {
                    $moisDansBase = $b['mois'];
                    if ($moisDansBase == $mois) {
                        $trouve = true;
                        break;
                    }
                }
    
                if ($trouve) {
                    $titre = "Bénéfice du mois de " . $mois .$annee;
                    $typeAffiche = "mois";

                } else {
                    $benefices = [];
                    $messageErreur = "Aucun bénéfice trouvé pour le mois de " . $mois." " .$annee;
                    $typeAffiche = "mois";
                }
    
            } elseif (!empty($annee)) {
                $benefices = $Livraison->getBeneficeParAnnee($annee);
    
                $trouve = false;
                foreach ($benefices as $b) {
                    if ($b['annee'] == $annee) {
                        $trouve = true;
                        break;
                    }
                }
                if ($trouve) {
                    $titre = "Bénéfice de l'année $annee";
                    $typeAffiche = "annee";
                   
                } else {
                    $benefices = []; 
                    $messageErreur = "Aucun bénéfice trouvé pour l'année $annee";
                    $typeAffiche = "annee";
                }

            } else {
                $benefices = $Livraison->getBenefice(); 
    
                if (empty($benefices)) {
                    $messageErreur = "Aucune donnée de bénéfice disponible pour le moment.";
                } else {
                    $titre = "Bénéfices par de la societe";
                    $typeAffiche = "jour";
                }
            }
    
        } catch (\Exception $e) {
            $benefices = [];
            $messageErreur = "Erreur lors du chargement des données. Veuillez réessayer plus tard.";
            error_log($e->getMessage());
        }
    
        Flight::render('benef', [
            'benefices'     => $benefices,
            'titre'         => $titre,
            'typeAffiche'   => $typeAffiche,
            'jour'          => $jour,
            'mois'          => $mois,
            'annee'         => $annee,
            'messageErreur' => $messageErreur
        ]);
    }

    public function insererLivraison(){
        $db = Flight::db();
        $date = $_POST['date_livraison'];
        $id_vehicule = $_POST['id_vehicule'];
        $id_livreur = $_POST['id_livreur'];
        $id_colis = $_POST['id_colis'] ?? '';
        $addresse_depart = $_POST['adresse_depart'];
        $zone = $_POST['id_zone'];
        $statut = $_POST['id_statut'];
        $cout_vehicule = $_POST['cout_vehicule'];
        try {
            $livraison = new Livraison($db);
            $livraison->insertLivraison($date, $id_vehicule, $id_livreur, $id_colis, $addresse_depart, $zone, $statut, $cout_vehicule);
            echo "Livraison inserer avec succes";
        } catch (\Throwable $e) {
            echo "Erreur lors de la creation";
        }
    }
        public function modifierLivraison(){
        $db = Flight::db();
        $id = $_POST['id_livraison'];
        $date = $_POST['date_livraison'];
        $id_vehicule = $_POST['id_vehicule'];
        $id_livreur = $_POST['id_livreur'];
        $id_colis = $_POST['id_colis'] ?? '';
        $addresse_depart = $_POST['adresse_depart'];
        $zone = $_POST['id_zone'];
        $statut = $_POST['id_statut'];
        $cout_vehicule = $_POST['cout_vehicule'];
        try {
            $livraison = new Livraison($db);
            $livraison-> updateLivraison($id,$date, $id_vehicule, $id_livreur, $id_colis, $addresse_depart, $zone, $statut, $cout_vehicule);
            echo "Livraison modifier avec succes";
        } catch (\Throwable $e) {
            echo "Erreur lors de la modification";
        }
    }
}

?>]