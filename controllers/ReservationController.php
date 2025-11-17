<?php
require_once __DIR__ . '/../models/ReservationModel.php';
require_once __DIR__ . '/../models/VoyageModel.php';
require_once __DIR__ . '/../models/VilleModel.php';

/**
 * Contrôleur pour la gestion des réservations client
 */
class ReservationController {
    private ReservationModel $reservationModel;
    private VoyageModel $voyageModel;
    private VilleModel $villeModel;
    
    public function __construct() {
        $this->reservationModel = new ReservationModel();
        $this->voyageModel = new VoyageModel();
        $this->villeModel = new VilleModel();
    }
    
    /**
     * Vérifie que le client est connecté
     */
    private function requireLogin() {
        if (empty($_SESSION['client_id'])) {
            $_SESSION['message'] = 'Veuillez vous connecter pour accéder à cette page.';
            $_SESSION['message_type'] = 'error';
            header('Location: /client/login');
            exit;
        }
    }
    
    /**
     * Affiche la page de recherche de voyages
     */
    public function searchAction() {
        $this->requireLogin();
        
        $villes = $this->villeModel->getAllVilles();
        $voyages = [];
        $searchParams = [];
        
        // Si une recherche est soumise
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $searchParams = [
                'ville_depart' => $_POST['ville_depart'] ?? '',
                'ville_arrivee' => $_POST['ville_arrivee'] ?? '',
                'date' => $_POST['date'] ?? ''
            ];
            
            // Récupérer tous les voyages et filtrer
            $allVoyages = $this->voyageModel->getAllVoyages();
            $voyages = array_filter($allVoyages, function($voyage) use ($searchParams) {
                $matchDepart = empty($searchParams['ville_depart']) || 
                               $voyage['ville_depart'] == $searchParams['ville_depart'];
                $matchArrivee = empty($searchParams['ville_arrivee']) || 
                                $voyage['ville_arrivee'] == $searchParams['ville_arrivee'];
                $matchDate = empty($searchParams['date']) || 
                             substr($voyage['date_heure_depart'], 0, 10) == $searchParams['date'];
                return $matchDepart && $matchArrivee && $matchDate;
            });
        }
        
        $pageTitle = "Rechercher un Voyage";
        $content = __DIR__ . '/../views/client/voyage_recherche.php';
        include __DIR__ . '/../views/client/layout.php';
    }
    
    /**
     * Affiche le formulaire de confirmation de réservation
     */
    public function confirmAction($id_voyage) {
        $this->requireLogin();
        
        $voyage = $this->voyageModel->getVoyageById($id_voyage);
        if (!$voyage) {
            $_SESSION['message'] = 'Voyage non trouvé.';
            $_SESSION['message_type'] = 'error';
            header('Location: /client/voyages');
            exit;
        }
        
        // Générer les numéros de sièges disponibles
        $sieges = range(1, $voyage['nombre_sieges']);
        
        $pageTitle = "Confirmer la Réservation";
        $content = __DIR__ . '/../views/client/reservation_confirmer.php';
        include __DIR__ . '/../views/client/layout.php';
    }
    
    /**
     * Traite la création d'une réservation
     */
    public function createAction() {
        $this->requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_voyage = $_POST['id_voyage'] ?? 0;
            $siege_assigne = $_POST['siege_assigne'] ?? 0;
            $id_client = $_SESSION['client_id'];
            
            if (empty($id_voyage) || empty($siege_assigne)) {
                $_SESSION['message'] = 'Veuillez sélectionner un voyage et un siège.';
                $_SESSION['message_type'] = 'error';
                header('Location: /client/voyages');
                exit;
            }
            
            if ($this->reservationModel->createReservation($id_client, $id_voyage, $siege_assigne)) {
                $_SESSION['message'] = 'Réservation confirmée avec succès!';
                $_SESSION['message_type'] = 'success';
                header('Location: /client/reservations');
                exit;
            } else {
                $_SESSION['message'] = 'Erreur lors de la création de la réservation.';
                $_SESSION['message_type'] = 'error';
                header('Location: /client/voyages');
                exit;
            }
        }
    }
    
    /**
     * Affiche les réservations du client
     */
    public function listAction() {
        $this->requireLogin();
        
        $id_client = $_SESSION['client_id'];
        $reservations = $this->reservationModel->getReservationsByClient($id_client);
        
        $pageTitle = "Mes Réservations";
        $content = __DIR__ . '/../views/client/reservation_liste.php';
        include __DIR__ . '/../views/client/layout.php';
    }
    
    /**
     * Annule une réservation
     */
    public function cancelAction($id_reservation) {
        $this->requireLogin();
        
        if ($this->reservationModel->cancelReservation($id_reservation)) {
            $_SESSION['message'] = 'Réservation annulée avec succès!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Erreur lors de l\'annulation.';
            $_SESSION['message_type'] = 'error';
        }
        
        header('Location: /client/reservations');
        exit;
    }
}
?>
