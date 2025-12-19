<?php

namespace app\models;

use PDO;

class Colis
{

    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getColis()
    {
        $stmt = $this->db->prepare("select * from exam_colis");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getInfoColis(){
        $sql = "SELECT * FROM vue_prix_colis";
        $stmt = $this->db->prepare($sql);  
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
