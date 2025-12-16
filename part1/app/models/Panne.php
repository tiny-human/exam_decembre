<?php

namespace app\models;
use PDO;

class Panne{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function vehiculeDispo($date){
        $sql = "SELECT v.id_vehicule, v.immatriculation
                FROM vehicule v
                LEFT JOIN vue_liste_panne p
                ON v.id_vehicule = p.id_vehicule
                AND :date BETWEEN p.debut_panne AND p.fin_panne
                WHERE p.id_panne IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['date' => $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    public function getPourcentage(){
        $sql = "SELECT 
                    p.id_vehicule,
                    v.immatriculation,
                    YEAR(p.debut_panne) AS annee,
                    MONTH(p.debut_panne) AS mois,
                    COUNT(*) AS nb_pannes
                FROM panne p 
                JOIN vehicule v ON p.id_vehicule = v.id_vehicule
                GROUP BY p.id_vehicule, annee, mois
                ORDER BY p.id_vehicule, annee, mois";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $finalResults = [];
        foreach ($results as $ligne) {
            $ligne['taux_panne'] = ($ligne['nb_pannes'] / 25) * 100;
            $finalResults[] = $ligne;
        }
        return $finalResults;
}



}

?>