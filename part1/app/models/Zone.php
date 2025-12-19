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
        $stmt = $this->db->prepare("select * from exam_zone");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addZone($nom,$pourcentage){
        $sql = "INSERT INTO exam_zone(nom_zone,pourcentage) VALUES(?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nom,$pourcentage]);
    }
        public function modifierZone($nom,$pourcentage , $id){
        $sql = "UPDATE exam_zone SET nom_zone = ? , pourcentage = ? WHERE id_zone = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nom,$pourcentage,$id]);
    }
        public function supprimerZone($id){
        $sql = "DELETE FROM exam_zone WHERE id_zone = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
    }
}
