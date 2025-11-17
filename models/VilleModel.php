<?php
require_once 'BaseModel.php';

/**
 * Modèle pour la gestion des villes
 */
class VilleModel extends BaseModel {
    protected string $table = 'Ville';
    
    /**
     * Récupère toutes les villes
     */
    public function getAllVilles(): array {
        $query = "SELECT * FROM {$this->table} ORDER BY nom_ville ASC";
        return $this->fetchAll($query);
    }
    
    /**
     * Récupère une ville par son ID
     */
    public function getVilleById(int $id) {
        $query = "SELECT * FROM {$this->table} WHERE id_ville = ?";
        return $this->fetchOne($query, [$id]);
    }
}
?>
