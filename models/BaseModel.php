<?php
/**
 * Classe de base abstraite pour tous les modèles
 * Fournit la connexion PDO et les méthodes communes pour SQL Server
 */
abstract class BaseModel {
    protected PDO $pdo;
    protected string $table;
    
    public function __construct() {
        $this->pdo = Database::getInstance()->getPDO();
    }
    
    /**
     * Exécute une requête SELECT et retourne les résultats
     */
    protected function fetchAll(string $query, array $params = []): array {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    /**
     * Exécute une requête et retourne une seule ligne
     */
    protected function fetchOne(string $query, array $params = []) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch();
    }
    
    /**
     * Exécute une requête d'insertion, modification ou suppression
     */
    protected function execute(string $query, array $params = []): int {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->rowCount();
    }
    
    /**
     * Retourne l'ID de la dernière insertion (SQL Server compatible)
     * SQL Server n'utilise pas lastInsertId() directement, utiliser SCOPE_IDENTITY()
     */
    protected function lastInsertId(): int {
        $result = $this->pdo->query("SELECT CAST(SCOPE_IDENTITY() as int) as id")->fetch();
        return $result['id'] ?? 0;
    }
}
?>
