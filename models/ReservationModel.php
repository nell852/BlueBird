<?php
require_once 'BaseModel.php';

/**
 * Modèle pour la gestion des réservations
 */
class ReservationModel extends BaseModel {
    protected string $table = 'Reservation';
    
    /**
     * Récupère toutes les réservations
     */
    public function getAllReservations(): array {
        $query = "SELECT r.*, 
                         c.nom, c.prenom, c.email,
                         v.date_heure_depart, v.tarif,
                         vd.nom_ville as ville_depart,
                         va.nom_ville as ville_arrivee
                  FROM {$this->table} r
                  LEFT JOIN Client c ON r.id_client = c.id_client
                  LEFT JOIN Voyage v ON r.id_voyage = v.id_voyage
                  LEFT JOIN Ville vd ON v.ville_depart = vd.id_ville
                  LEFT JOIN Ville va ON v.ville_arrivee = va.id_ville
                  ORDER BY r.date_reservation DESC";
        return $this->fetchAll($query);
    }
    
    /**
     * Récupère les réservations d'un client
     */
    public function getReservationsByClient(int $id_client): array {
        $query = "SELECT r.*, 
                         v.date_heure_depart, v.tarif,
                         vd.nom_ville as ville_depart,
                         va.nom_ville as ville_arrivee
                  FROM {$this->table} r
                  LEFT JOIN Voyage v ON r.id_voyage = v.id_voyage
                  LEFT JOIN Ville vd ON v.ville_depart = vd.id_ville
                  LEFT JOIN Ville va ON v.ville_arrivee = va.id_ville
                  WHERE r.id_client = ?
                  ORDER BY r.date_reservation DESC";
        return $this->fetchAll($query, [$id_client]);
    }
    
    /**
     * Crée une réservation
     */
    public function createReservation(int $id_client, int $id_voyage, int $siege_assigne): bool {
        $query = "INSERT INTO {$this->table} (id_client, id_voyage, siege_assigne, statut) 
                  VALUES (?, ?, ?, 'confirmée')";
        return $this->execute($query, [$id_client, $id_voyage, $siege_assigne]) > 0;
    }
    
    /**
     * Met à jour le statut d'une réservation
     */
    public function updateReservationStatus(int $id_reservation, string $statut): bool {
        $query = "UPDATE {$this->table} SET statut = ? WHERE id_reservation = ?";
        return $this->execute($query, [$statut, $id_reservation]) > 0;
    }
    
    /**
     * Annule une réservation
     */
    public function cancelReservation(int $id_reservation): bool {
        return $this->updateReservationStatus($id_reservation, 'annulée');
    }
}
?>
