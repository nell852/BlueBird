<?php
class Database {
    private static ?Database $instance = null;
    private PDO $pdo;

    private function __construct() {
        try {
            $server = 'localhost';
            $database = 'bluebird_express';
            
            $dsn = "sqlsrv:Server=$server;Database=$database";

            $this->pdo = new PDO($dsn, null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

        } catch (PDOException $e) {
            die("Erreur de connexion SQL Server: " . $e->getMessage());
        }
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPDO(): PDO {
        return $this->pdo;
    }
}
?>
