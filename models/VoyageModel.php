<?php
require_once 'BaseModel.php';

/**
 * Modèle pour la gestion des voyages
 */
class VoyageModel extends BaseModel {
    protected string $table = 'Voyage';
    
    /**
     * Récupère tous les voyages avec détails véhicule et chauffeur
     */
    public function getAllVoyages(): array {
        $query = "SELECT v.*, 
                         ve.immatriculation, ve.marque, ve.nombre_sieges,
                         c.nombre_sieges as sieges_total,
                         e.nom, e.prenom,
                         vd.nom_ville as ville_depart_nom,
                         va.nom_ville as ville_arrivee_nom
                  FROM {$this->table} v
                  LEFT JOIN Vehicule ve ON v.id_vehicule = ve.id_vehicule
                  LEFT JOIN Chauffeur c ON v.id_chauffeur = c.id_employe
                  LEFT JOIN Employe e ON c.id_employe = e.id_employe
                  LEFT JOIN Ville vd ON v.ville_depart = vd.id_ville
                  LEFT JOIN Ville va ON v.ville_arrivee = va.id_ville
                  ORDER BY v.date_heure_depart DESC";
        return $this->fetchAll($query);
    }
    
    /**
     * Récupère un voyage par son ID
     */
    public function getVoyageById(int $id) {
        $query = "SELECT v.*, 
                         ve.immatriculation, ve.marque, ve.nombre_sieges,
                         e.nom, e.prenom,
                         vd.nom_ville as ville_depart_nom,
                         va.nom_ville as ville_arrivee_nom
                  FROM {$this->table} v
                  LEFT JOIN Vehicule ve ON v.id_vehicule = ve.id_vehicule
                  LEFT JOIN Chauffeur c ON v.id_chauffeur = c.id_employe
                  LEFT JOIN Employe e ON c.id_employe = e.id_employe
                  LEFT JOIN Ville vd ON v.ville_depart = vd.id_ville
                  LEFT JOIN Ville va ON v.ville_arrivee = va.id_ville
                  WHERE v.id_voyage = ?";
        return $this->fetchOne($query, [$id]);
    }
    
    /**
     * Crée un nouveau voyage
     */
    public function createVoyage(array $data): bool {
        $query = "INSERT INTO {$this->table} (id_vehicule, id_chauffeur, ville_depart, ville_arrivee, date_heure_depart, tarif) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        return $this->execute($query, [
            $data['id_vehicule'],
            $data['id_chauffeur'],
            $data['ville_depart'],
            $data['ville_arrivee'],
            $data['date_heure_depart'],
            $data['tarif']
        ]) > 0;
    }
    
    /**
     * Supprime un voyage
     */
    public function deleteVoyage(int $id): bool {
        $query = "DELETE FROM {$this->table} WHERE id_voyage = ?";
        return $this->execute($query, [$id]) > 0;
    }
}
?>
