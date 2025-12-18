<?php

namespace app\models;

use PDO;

class Statut
{

    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getStatut()
    {
        $stmt = $this->db->prepare("select * from exam_statut");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
