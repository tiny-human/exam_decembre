<?php

namespace app\models;
use PDO;

class Livreur
{

    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
}