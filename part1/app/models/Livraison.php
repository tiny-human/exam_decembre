<?php

namespace app\models;
use PDO;

class Livraison
{

    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    function getCoutRevient(){
        $sql = "SELECT id_livraison , sum(cout_vehicule + salaire_chauffeur) as cout_revient FROM v_livraison_detail_cout GROUP BY id_livraison";
        $stmt = $this ->db->prepare($sql);
        $stmt->execute();
        $cout = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cout;
    }
        function insertLivraison($date,$id_vehicule,$id_livreur,$id_colis,$addresse_depart,$zone,$statut,$cout_vehicule){
        $sql = "INSERT INTO exam_livraison (date_livraison, id_vehicule, id_livreur, id_colis, adresse_depart, id_zone, id_statut, cout_vehicule) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        // Préparation de la requête
        $stmt = $this->db->prepare($sql);
        $success = $stmt->execute([
            $date,
            $id_vehicule,
            $id_livreur,
            $id_colis,
            $addresse_depart,
            $zone,
            $statut,
            $cout_vehicule
        ]);
        
    }
}
