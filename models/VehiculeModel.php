<?php
require_once 'BaseModel.php';

/**
 * Modèle pour la gestion des véhicules
 */
class VehiculeModel extends BaseModel {
    protected string $table = 'Vehicule';
    
    /**
     * Récupère tous les véhicules
     */
    public function getAllVehicules(): array {
        $query = "SELECT * FROM {$this->table} ORDER BY immatriculation";
        return $this->fetchAll($query);
    }
    
    /**
     * Récupère un véhicule par son ID
     */
    public function getVehiculeById(int $id) {
        $query = "SELECT * FROM {$this->table} WHERE id_vehicule = ?";
        return $this->fetchOne($query, [$id]);
    }
    
    /**
     * Crée un nouveau véhicule
     */
    public function createVehicule(array $data): bool {
        $query = "INSERT INTO {$this->table} (immatriculation, marque, modele, nombre_sieges, annee_acquisition, statut) 
                  VALUES (?, ?, ?, ?, ?, 'disponible')";
        return $this->execute($query, [
            $data['immatriculation'],
            $data['marque'],
            $data['modele'] ?? '',
            $data['nombre_sieges'],
            $data['annee_acquisition'] ?? date('Y')
        ]) > 0;
    }
    
    /**
     * Met à jour un véhicule
     */
    public function updateVehicule(int $id, array $data): bool {
        $query = "UPDATE {$this->table} SET marque = ?, modele = ?, nombre_sieges = ?, statut = ? WHERE id_vehicule = ?";
        return $this->execute($query, [
            $data['marque'],
            $data['modele'],
            $data['nombre_sieges'],
            $data['statut'] ?? 'disponible',
            $id
        ]) > 0;
    }
    
    /**
     * Supprime un véhicule
     */
    public function deleteVehicule(int $id): bool {
        $query = "DELETE FROM {$this->table} WHERE id_vehicule = ?";
        return $this->execute($query, [$id]) > 0;
    }
}
?>
