<?php

class Database
{
    private $host = 'localhost';
    private $db = 'apigraphqljeux';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';

    private $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }

    // Exécute une requête SQL
    public function executeQuery($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Erreur d'exécution de la requête SQL: " . $e->getMessage());
        }
    }

    // Récupère toutes les lignes d'un résultat de requête
    public function fetchAll($stmt)
    {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère une seule ligne d'un résultat de requête
    public function fetch($stmt)
    {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
