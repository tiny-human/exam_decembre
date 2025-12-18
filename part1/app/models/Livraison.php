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

    public function getLivraison() {
        $sql = "SELECT l.date_livraison AS dates, v.numero AS vehicule,liv.nom AS livreur, z.nom_zone AS zone, s.statut AS statut 
        FROM exam_livraison l JOIN exam_vehicule v ON v.id_vehicule = l.id_vehicule 
        JOIN exam_livreur liv ON liv.id_livreur = l.id_livreur 
        JOIN exam_statut s ON s.id_statut = l.id_statut 
        JOIN exam_zone z ON z.id_zone = l.id_zone CROSS JOIN exam_params_poids p";
        $stmt = $this->db->prepare($sql);  
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInfoColis(){
        $sql = "SELECT * FROM vue_prix_colis";
        $stmt = $this->db->prepare($sql);  
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBeneficeParJour() {
        $sql = "SELECT * FROM vue_benefice_par_jour";
        $stmt = $this->db->prepare($sql);  
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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


