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

}
