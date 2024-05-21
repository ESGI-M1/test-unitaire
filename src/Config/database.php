<?php

namespace src\Config;

use src\Entity\User;
use src\Entity\Item;
use \PDO;
use \PDOException;

class DataBase{

    private $host = "localhost"; // Adresse de l'hôte de la base de données MySQL
    private $db_name = "mydatabase"; // Nom de la base de données
    private $username = "myuser"; // Nom d'utilisateur de la base de données
    private $password = "mypassword"; // Mot de passe de la base de données
    private $conn;

    public function getConnection() : PDO {

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }
        catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    public static function initDataBase() : void {
        try {
            $conn = (new DataBase())->getConnection();
            $conn->exec(User::initDatabase());
            $conn->exec(Item::initDatabase());
        } catch (PDOException $exception) {
            echo "Database error: " . $exception->getMessage();
        }
        
    }

}
