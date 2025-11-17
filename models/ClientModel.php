<?php
require_once 'BaseModel.php';

/**
 * Modèle pour la gestion des clients
 */
class ClientModel extends BaseModel {
    protected string $table = 'Client';
    
    /**
     * Récupère tous les clients
     */
    public function getAllClients(): array {
        $query = "SELECT * FROM {$this->table} ORDER BY date_inscription DESC";
        return $this->fetchAll($query);
    }
    
    /**
     * Récupère un client par son ID
     */
    public function getClientById(int $id) {
        $query = "SELECT * FROM {$this->table} WHERE id_client = ?";
        return $this->fetchOne($query, [$id]);
    }
    
    /**
     * Récupère un client par son email
     */
    public function getClientByEmail(string $email) {
        $query = "SELECT * FROM {$this->table} WHERE email = ?";
        return $this->fetchOne($query, [$email]);
    }
    
    /**
     * Crée un nouveau client (inscription)
     */
    public function register(string $nom, string $prenom, string $email, string $password, string $telephone): bool {
        // Vérifier si l'email existe déjà
        if ($this->getClientByEmail($email)) {
            return false;
        }
        
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO {$this->table} (nom, prenom, email, password, telephone) 
                  VALUES (?, ?, ?, ?, ?)";
        return $this->execute($query, [$nom, $prenom, $email, $hashedPassword, $telephone]) > 0;
    }
    
    /**
     * Vérifie les identifiants de connexion
     */
    public function login(string $email, string $password): ?array {
        $client = $this->getClientByEmail($email);
        if ($client && password_verify($password, $client['password'])) {
            return $client;
        }
        return null;
    }
    
    /**
     * Crée un client via l'admin
     */
    public function createClient(array $data): bool {
        $query = "INSERT INTO {$this->table} (nom, prenom, email, password, telephone) 
                  VALUES (?, ?, ?, ?, ?)";
        $hashedPassword = password_hash($data['password'] ?? 'default123', PASSWORD_BCRYPT);
        return $this->execute($query, [
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $hashedPassword,
            $data['telephone'] ?? ''
        ]) > 0;
    }
    
    /**
     * Met à jour un client
     */
    public function updateClient(int $id, array $data): bool {
        $query = "UPDATE {$this->table} SET nom = ?, prenom = ?, telephone = ? WHERE id_client = ?";
        return $this->execute($query, [
            $data['nom'],
            $data['prenom'],
            $data['telephone'] ?? '',
            $id
        ]) > 0;
    }
    
    /**
     * Supprime un client
     */
    public function deleteClient(int $id): bool {
        $query = "DELETE FROM {$this->table} WHERE id_client = ?";
        return $this->execute($query, [$id]) > 0;
    }
}
?>
