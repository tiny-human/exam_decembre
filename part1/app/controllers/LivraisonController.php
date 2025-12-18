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

        $liste   = $Livraison->getLivraison();        // Liste des livraisons
        $cout    = $Livraison->getCoutRevient();      // Coûts de revient par livraison
        $recette = $Colis->getInfoColis();            // Données pour le chiffre d'affaires / recette
 
        Flight::render('liste', [
            'liste'   => $liste,
            'cout'    => $cout,
            'recette' => $recette
        ]);
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
                $benefices = $Livraison->getBeneficeParMois($mois);
    
                $trouve = false;
                foreach ($benefices as $b) {
                    $moisDansBase = $b['annee'] . '-' . str_pad($b['num_mois'] ?? $b['mois'], 2, '0', STR_PAD_LEFT);
                    if ($moisDansBase == $mois) {
                        $trouve = true;
                        break;
                    }
                }
    
                if ($trouve) {
                    $dateObj = DateTime::createFromFormat('Y-m', $mois);
                    $titre = "Bénéfice de " . $dateObj->format('F Y');
                    $typeAffiche = "mois";
                } else {
                    $benefices = [];
                    $dateObj = DateTime::createFromFormat('Y-m', $mois);
                    $moisNom = $dateObj ? $dateObj->format('F Y') : $mois;
                    $messageErreur = "Aucun bénéfice trouvé pour le mois de $moisNom";
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
                $benefices = $Livraison->getBeneficeParJour(); 
    
                if (empty($benefices)) {
                    $messageErreur = "Aucune donnée de bénéfice disponible pour le moment.";
                } else {
                    $titre = "Bénéfices par de la societe";
                    $typeAffiche = "mois";
                }
            }
    
        } catch (Exception $e) {
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

?>]