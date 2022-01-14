<?php

namespace App;
use \PDO;

class Connector
{
    public static function getPDO(): PDO
    {
        return new PDO('mysql:dbname=projet_final_php;host:127.0.0.1', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}
