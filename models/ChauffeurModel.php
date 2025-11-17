<?php
require_once 'BaseModel.php';

/**
 * Modèle pour la gestion des chauffeurs
 */
class ChauffeurModel extends BaseModel {
    protected string $table = 'Chauffeur';
    
    /**
     * Récupère tous les chauffeurs
     */
    public function getAllChauffeurs(): array {
        $query = "SELECT c.*, e.nom, e.prenom FROM {$this->table} c
                  LEFT JOIN Employe e ON c.id_employe = e.id_employe
                  ORDER BY e.nom, e.prenom";
        return $this->fetchAll($query);
    }
    
    /**
     * Récupère un chauffeur par son ID
     */
    public function getChauffeurById(int $id) {
        $query = "SELECT c.*, e.nom, e.prenom FROM {$this->table} c
                  LEFT JOIN Employe e ON c.id_employe = e.id_employe
                  WHERE c.id_employe = ?";
        return $this->fetchOne($query, [$id]);
    }
}
?>
