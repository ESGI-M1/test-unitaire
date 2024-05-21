<?php

namespace src\Config;

class DataBase{

    private $host = "localhost"; // Adresse de l'hôte de la base de données MySQL
    private $db_name = "mydatabase"; // Nom de la base de données
    private $username = "myuser"; // Nom d'utilisateur de la base de données
    private $password = "mypassword"; // Mot de passe de la base de données
    private $conn;

    public function getConnection(){

        $this->conn = null;

        try {
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }
        catch(\PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    public static function initDataBase() : string {
        Item::initDataBase();
        User::initDataBase();
    }

}
