<?php

namespace app\models;

use PDO;

class Vehicule
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getVehicules()
    {
        $stmt = $this->db->prepare("select * from exam_vehicule");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
