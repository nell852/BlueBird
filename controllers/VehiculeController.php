<?php
require_once __DIR__ . '/../models/VehiculeModel.php';

/**
 * Contrôleur pour la gestion des véhicules
 */
class VehiculeController {
    private VehiculeModel $vehiculeModel;
    
    public function __construct() {
        $this->vehiculeModel = new VehiculeModel();
    }
    
    /**
     * Affiche la liste de tous les véhicules
     */
    public function listAction() {
        $vehicules = $this->vehiculeModel->getAllVehicules();
        $pageTitle = "🚌 Gestion des Véhicules";
        $content = __DIR__ . '/../views/admin/vehicule_liste.php';
        include __DIR__ . '/../views/admin/layout.php';
    }
    
    /**
     * Affiche le formulaire d'ajout d'un véhicule
     */
    public function addAction() {
        $pageTitle = "➕ Ajouter un Véhicule";
        $content = __DIR__ . '/../views/admin/vehicule_ajouter.php';
        include __DIR__ . '/../views/admin/layout.php';
    }
    
    /**
     * Traite l'ajout d'un véhicule
     */
    public function createAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'immatriculation' => $_POST['immatriculation'] ?? '',
                'marque' => $_POST['marque'] ?? '',
                'modele' => $_POST['modele'] ?? '',
                'nombre_sieges' => $_POST['nombre_sieges'] ?? 0,
                'annee_acquisition' => $_POST['annee_acquisition'] ?? date('Y')
            ];
            
            if ($this->vehiculeModel->createVehicule($data)) {
                $_SESSION['message'] = 'Véhicule ajouté avec succès!';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Erreur lors de l\'ajout du véhicule.';
                $_SESSION['message_type'] = 'error';
            }
            
            header('Location: /admin/vehicules');
            exit;
        }
    }
    
    /**
     * Affiche le formulaire de modification d'un véhicule
     */
    public function editAction($id) {
        $vehicule = $this->vehiculeModel->getVehiculeById($id);
        if (!$vehicule) {
            $_SESSION['message'] = 'Véhicule non trouvé.';
            $_SESSION['message_type'] = 'error';
            header('Location: /admin/vehicules');
            exit;
        }
        $pageTitle = "✏️ Modifier le Véhicule";
        $content = __DIR__ . '/../views/admin/vehicule_modifier.php';
        include __DIR__ . '/../views/admin/layout.php';
    }
    
    /**
     * Traite la modification d'un véhicule
     */
    public function updateAction($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'marque' => $_POST['marque'] ?? '',
                'modele' => $_POST['modele'] ?? '',
                'nombre_sieges' => $_POST['nombre_sieges'] ?? 0,
                'statut' => $_POST['statut'] ?? 'disponible'
            ];
            
            if ($this->vehiculeModel->updateVehicule($id, $data)) {
                $_SESSION['message'] = 'Véhicule modifié avec succès!';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Erreur lors de la modification.';
                $_SESSION['message_type'] = 'error';
            }
            
            header('Location: /admin/vehicules');
            exit;
        }
    }
    
    /**
     * Supprime un véhicule
     */
    public function deleteAction($id) {
        if ($this->vehiculeModel->deleteVehicule($id)) {
            $_SESSION['message'] = 'Véhicule supprimé avec succès!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Erreur lors de la suppression.';
            $_SESSION['message_type'] = 'error';
        }
        
        header('Location: /admin/vehicules');
        exit;
    }
}
?>
