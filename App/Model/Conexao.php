<?php

namespace App\Model;
use PDO;
// use PDOException;

// classe conexão ja instaciada, assim eu só utilzo somente o Conexao:: funcão() sempre que eu precisar  

class Conexao {
    private static $instance;

    public static function getConexao(){
        if (!isset(self::$instance)) {
            self::$instance = new \PDO('mysql:host=localhost;dbname=biblioteca;charset=utf8mb4','matheus','matheus');
        }
        return self::$instance;
    }
}


