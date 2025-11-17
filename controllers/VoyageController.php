<?php
require_once __DIR__ . '/../models/VoyageModel.php';
require_once __DIR__ . '/../models/VehiculeModel.php';
require_once __DIR__ . '/../models/ChauffeurModel.php';
require_once __DIR__ . '/../models/VilleModel.php';

/**
 * Contrôleur pour la gestion des voyages
 */
class VoyageController {
    private VoyageModel $voyageModel;
    private VehiculeModel $vehiculeModel;
    private ChauffeurModel $chauffeurModel;
    private VilleModel $villeModel;
    
    public function __construct() {
        $this->voyageModel = new VoyageModel();
        $this->vehiculeModel = new VehiculeModel();
        $this->chauffeurModel = new ChauffeurModel();
        $this->villeModel = new VilleModel();
    }
    
    /**
     * Affiche la liste de tous les voyages
     */
    public function listAction() {
        $voyages = $this->voyageModel->getAllVoyages();
        $pageTitle = "✈️ Gestion des Voyages";
        $content = __DIR__ . '/../views/admin/voyage_liste.php';
        include __DIR__ . '/../views/admin/layout.php';
    }
    
    /**
     * Affiche le formulaire d'ajout d'un voyage
     */
    public function addAction() {
        $vehicules = $this->vehiculeModel->getAllVehicules();
        $chauffeurs = $this->chauffeurModel->getAllChauffeurs();
        $villes = $this->villeModel->getAllVilles();
        
        $pageTitle = "➕ Ajouter un Voyage";
        $content = __DIR__ . '/../views/admin/voyage_ajouter.php';
        include __DIR__ . '/../views/admin/layout.php';
    }
    
    /**
     * Traite l'ajout d'un voyage
     */
    public function createAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_vehicule' => $_POST['id_vehicule'] ?? 0,
                'id_chauffeur' => $_POST['id_chauffeur'] ?? 0,
                'ville_depart' => $_POST['ville_depart'] ?? 0,
                'ville_arrivee' => $_POST['ville_arrivee'] ?? 0,
                'date_heure_depart' => $_POST['date_heure_depart'] ?? '',
                'tarif' => $_POST['tarif'] ?? 0
            ];
            
            if ($this->voyageModel->createVoyage($data)) {
                $_SESSION['message'] = 'Voyage créé avec succès!';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Erreur lors de la création du voyage.';
                $_SESSION['message_type'] = 'error';
            }
            
            header('Location: /admin/voyages');
            exit;
        }
    }
    
    /**
     * Supprime un voyage
     */
    public function deleteAction($id) {
        if ($this->voyageModel->deleteVoyage($id)) {
            $_SESSION['message'] = 'Voyage supprimé avec succès!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Erreur lors de la suppression.';
            $_SESSION['message_type'] = 'error';
        }
        
        header('Location: /admin/voyages');
        exit;
    }
}
?>
