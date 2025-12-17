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




