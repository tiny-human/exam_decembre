<?php

namespace app\models;

use PDO;

class Zone
{

    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getZones()
    {
        $stmt = $this->db->prepare("select * from exam_zone where id_statut_zone = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        public function getZonesParId($id)
    {
        $stmt = $this->db->prepare("select * from exam_zone where id_zone = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
         public function getStatutZones()
    {
        $stmt = $this->db->prepare("select * from exam_statut_zone");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addZone($nom,$pourcentage){
        $sql = "INSERT INTO exam_zone(nom_zone,pourcentage,id_statut_zone ) VALUES(?,?,1)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nom,$pourcentage]);
    }
        public function modifierZone($nom,$pourcentage , $id){
        $sql = "UPDATE exam_zone SET nom_zone = ? , pourcentage = ? WHERE id_zone = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nom,$pourcentage,$id]);
    }
        public function supprimerZone($id){
        $sql = "UPDATE exam_zone SET id_statut_zone = 2 WHERE id_zone = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
    }
}
