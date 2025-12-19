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
        $sql = "SELECT l.id_livraison, v.numero AS vehicule,liv.nom AS livreur,c.colis,l.date_livraison AS dates, z.nom_zone AS zone, s.statut AS statut 
        FROM exam_livraison l JOIN exam_vehicule v ON v.id_vehicule = l.id_vehicule 
        JOIN exam_livreur liv ON liv.id_livreur = l.id_livreur 
        JOIN exam_statut s ON s.id_statut = l.id_statut 
        JOIN exam_zone z ON z.id_zone = l.id_zone 
        JOIN vue_prix_colis c ON c.date_livraison = l.date_livraison";
        $stmt = $this->db->prepare($sql);  
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
      public function getLivraisonParId($id) {
        $sql = "SELECT l.id_livraison, l.cout_vehicule AS cout ,l.adresse_depart AS depart , v.numero AS vehicule,liv.nom AS livreur,c.colis,l.date_livraison AS dates, z.nom_zone AS zone, s.statut AS statut 
        FROM exam_livraison l JOIN exam_vehicule v ON v.id_vehicule = l.id_vehicule 
        JOIN exam_livreur liv ON liv.id_livreur = l.id_livreur 
        JOIN exam_statut s ON s.id_statut = l.id_statut 
        JOIN exam_zone z ON z.id_zone = l.id_zone 
        JOIN vue_prix_colis c ON c.date_livraison = l.date_livraison where l.id_livraison = ?";
        $stmt = $this->db->prepare($sql);  
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getBeneficeParJour() {
        $sql = "SELECT * FROM v_benefice_par_jour";
        $stmt = $this->db->prepare($sql);  
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBeneficeParMois() {
        $sql = "SELECT * FROM v_benefice_par_mois";
        $stmt = $this->db->prepare($sql);  
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBeneficeParAnnee() {
        $sql = "SELECT * FROM v_benefice_par_annee";
        $stmt = $this->db->prepare($sql);  
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCoutRevient(){
        $sql = "SELECT * FROM v_livraison_total_cout";
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
    function updateLivraison($id_livraison, $date, $id_vehicule, $id_livreur, $id_colis, $adresse_depart, $zone, $statut, $cout_vehicule) {
    $sql = "UPDATE exam_livraison 
            SET date_livraison = ?, 
                id_vehicule = ?, 
                id_livreur = ?, 
                id_colis = ?, 
                adresse_depart = ?, 
                id_zone = ?, 
                id_statut = ?, 
                cout_vehicule = ? 
            WHERE id_livraison = ?";
    
  
    $stmt = $this->db->prepare($sql);
  
    $success = $stmt->execute([
        $date,
        $id_vehicule,
        $id_livreur,
        $id_colis,
        $adresse_depart,
        $zone,
        $statut,
        $cout_vehicule,
        $id_livraison
    ]);
}

}


