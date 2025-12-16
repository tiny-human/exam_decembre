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
    public function getVehiculeByDate()
{
    $sql = "SELECT * FROM vue_trajets_par_jour";
    $stmt = $this->db->prepare($sql);  
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
   
public function benefvehicule() {
    $sql = "SELECT SUM(t.montant_recette-t.montant_carburant) as benefice, v.immatriculation as vehicule FROM trajet t JOIN vehicule v ON v.id_vehicule = t.id_vehicule GROUP BY v.id_vehicule";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function benefJour(){
    $sql = "SELECT * FROM vue_benefice_par_jour";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function rentabilite() {
    $sql = "SELECT * FROM vue_rentabilite";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
