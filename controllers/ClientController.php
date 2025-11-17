<?php
require_once __DIR__ . '/../models/ClientModel.php';

/**
 * Contrôleur pour la gestion des clients
 */
class ClientController {
    private ClientModel $clientModel;
    
    public function __construct() {
        $this->clientModel = new ClientModel();
    }
    
    /**
     * Affiche la liste de tous les clients
     */
    public function listAction() {
        $clients = $this->clientModel->getAllClients();
        $pageTitle = "👥 Gestion des Clients";
        $content = __DIR__ . '/../views/admin/client_liste.php';
        include __DIR__ . '/../views/admin/layout.php';
    }
    
    /**
     * Affiche le formulaire d'ajout d'un client
     */
    public function addAction() {
        $pageTitle = "➕ Ajouter un Client";
        $content = __DIR__ . '/../views/admin/client_ajouter.php';
        include __DIR__ . '/../views/admin/layout.php';
    }
    
    /**
     * Traite l'ajout d'un client
     */
    public function createAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'prenom' => $_POST['prenom'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'telephone' => $_POST['telephone'] ?? ''
            ];
            
            if ($this->clientModel->createClient($data)) {
                $_SESSION['message'] = 'Client ajouté avec succès!';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Erreur lors de l\'ajout du client.';
                $_SESSION['message_type'] = 'error';
            }
            
            header('Location: /admin/clients');
            exit;
        }
    }
    
    /**
     * Affiche le formulaire de modification d'un client
     */
    public function editAction($id) {
        $client = $this->clientModel->getClientById($id);
        if (!$client) {
            $_SESSION['message'] = 'Client non trouvé.';
            $_SESSION['message_type'] = 'error';
            header('Location: /admin/clients');
            exit;
        }
        $pageTitle = "✏️ Modifier le Client";
        $content = __DIR__ . '/../views/admin/client_modifier.php';
        include __DIR__ . '/../views/admin/layout.php';
    }
    
    /**
     * Traite la modification d'un client
     */
    public function updateAction($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'prenom' => $_POST['prenom'] ?? '',
                'telephone' => $_POST['telephone'] ?? ''
            ];
            
            if ($this->clientModel->updateClient($id, $data)) {
                $_SESSION['message'] = 'Client modifié avec succès!';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Erreur lors de la modification.';
                $_SESSION['message_type'] = 'error';
            }
            
            header('Location: /admin/clients');
            exit;
        }
    }
    
    /**
     * Supprime un client
     */
    public function deleteAction($id) {
        if ($this->clientModel->deleteClient($id)) {
            $_SESSION['message'] = 'Client supprimé avec succès!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Erreur lors de la suppression.';
            $_SESSION['message_type'] = 'error';
        }
        
        header('Location: /admin/clients');
        exit;
    }
}
?>
