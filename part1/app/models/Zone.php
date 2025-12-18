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
}
