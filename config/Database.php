<?php
class Database {
    private static ?Database $instance = null;
    private PDO $pdo;

    private function __construct() {
        try {
            $databaseUrl = getenv('DATABASE_URL');
            
            if ($databaseUrl) {
                $parsed = parse_url($databaseUrl);
                $host = $parsed['host'] ?? 'localhost';
                $port = $parsed['port'] ?? 5432;
                $database = ltrim($parsed['path'] ?? '', '/');
                $username = $parsed['user'] ?? '';
                $password = $parsed['pass'] ?? '';
                
                $dsn = "pgsql:host=$host;port=$port;dbname=$database";
            } else {
                $host = getenv('PGHOST') ?: 'localhost';
                $port = getenv('PGPORT') ?: '5432';
                $database = getenv('PGDATABASE') ?: 'bluebird_express';
                $username = getenv('PGUSER') ?: 'postgres';
                $password = getenv('PGPASSWORD') ?: '';
                
                $dsn = "pgsql:host=$host;port=$port;dbname=$database";
            }

            $this->pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);

        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            die("Erreur de connexion à la base de données. Veuillez vérifier la configuration.");
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
