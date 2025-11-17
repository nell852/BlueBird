<?php
/**
 * Point d'entrée principal - Routeur de l'application Blue Bird Express
 */

// Démarrage de la session
session_start();

// Chargement des fichiers de configuration et modèles
require_once __DIR__ . '/config/Database.php';

// Auto-loader pour les contrôleurs et modèles
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/controllers/' . $class . '.php',
        __DIR__ . '/models/' . $class . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Récupérer l'action et subaction depuis les paramètres GET
$action = $_GET['action'] ?? 'client';
$subaction = $_GET['subaction'] ?? 'login';
$id = $_GET['id'] ?? null;

// Redirection par défaut
if ($action === 'client' && $subaction === 'login' && !isset($_GET['action'])) {
    // Ceci est la première visite, laisser passer
}

if ($action === '/' || $action === '/index.php') {
    header('Location: index.php?action=client&subaction=login');
    exit;
}

try {
    if ($action === 'client' || $action === 'auth') {
        $authController = new AuthController();
        $reservationController = new ReservationController();
        
        switch ($subaction) {
            case 'login':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $authController->loginAction();
                } else {
                    $authController->loginFormAction();
                }
                break;
            
            case 'register':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $authController->registerAction();
                } else {
                    $authController->registerFormAction();
                }
                break;
            
            case 'logout':
                $authController->logoutAction();
                break;
            
            case 'voyages':
            case 'search':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $reservationController->searchAction();
                } else {
                    $reservationController->searchAction();
                }
                break;
            
            case 'reservation-confirm':
            case 'confirm':
                $reservationController->confirmAction($id);
                break;
            
            case 'reservation-create':
            case 'create':
                $reservationController->createAction();
                break;
            
            case 'reservation-cancel':
            case 'cancel':
                $reservationController->cancelAction($id);
                break;
            
            case 'reservations':
            case 'list':
                if (!isset($_SESSION['client_id'])) {
                    header('Location: index.php?action=client&subaction=login');
                    exit;
                }
                $reservationController->listAction();
                break;
            
            default:
                $authController->loginFormAction();
                break;
        }
        exit;
    }
    
    if ($action === 'admin') {
        checkAdminAccess();
        $adminController = new AdminController();
        
        switch ($subaction) {
            case 'dashboard':
                $adminController->dashboardAction();
                break;
            
            case 'clients':
                $adminController->clientListAction();
                break;
            
            case 'client-add':
                $adminController->clientAddAction();
                break;
            
            case 'client-create':
                $adminController->clientCreateAction();
                break;
            
            case 'client-edit':
                $adminController->clientEditAction($id);
                break;
            
            case 'client-update':
                $adminController->clientUpdateAction($id);
                break;
            
            case 'client-delete':
                $adminController->clientDeleteAction($id);
                break;
            
            case 'vehicules':
                $adminController->vehiculeListAction();
                break;
            
            case 'vehicule-add':
                $adminController->vehiculeAddAction();
                break;
            
            case 'vehicule-create':
                $adminController->vehiculeCreateAction();
                break;
            
            case 'vehicule-edit':
                $adminController->vehiculeEditAction($id);
                break;
            
            case 'vehicule-update':
                $adminController->vehiculeUpdateAction($id);
                break;
            
            case 'vehicule-delete':
                $adminController->vehiculeDeleteAction($id);
                break;
            
            case 'voyages':
                $adminController->voyageListAction();
                break;
            
            case 'voyage-add':
                $adminController->voyageAddAction();
                break;
            
            case 'voyage-create':
                $adminController->voyageCreateAction();
                break;
            
            case 'voyage-delete':
                $adminController->voyageDeleteAction($id);
                break;
            
            case 'reservations':
                $adminController->reservationListAction();
                break;
            
            default:
                $adminController->dashboardAction();
                break;
        }
        exit;
    }
    
    if ($action === 'logout') {
        session_destroy();
        $_SESSION = [];
        header('Location: index.php?action=client&subaction=login');
        exit;
    }
    
    http_response_code(404);
    echo '<h1>404 - Page non trouvée</h1>';
    echo '<p>L\'action demandée n\'existe pas.</p>';
    echo '<a href="index.php?action=client&subaction=login">Retour à la connexion</a>';
    exit;
    
} catch (Exception $e) {
    http_response_code(500);
    echo '<h1>Erreur Serveur (500)</h1>';
    echo '<p>Erreur: ' . htmlspecialchars($e->getMessage()) . '</p>';
    if (defined('DEBUG') && DEBUG) {
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
    }
    exit;
}

/**
 * Vérifier l'accès admin
 */
function checkAdminAccess() {
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: index.php?action=client&subaction=login');
        exit;
    }
}

/**
 * Contrôleur Admin - Agrégatif pour simplicité
 */
class AdminController {
    private $clientController;
    private $vehiculeController;
    private $voyageController;
    private $reservationModel;
    
    public function __construct() {
        $this->clientController = new ClientController();
        $this->vehiculeController = new VehiculeController();
        $this->voyageController = new VoyageController();
        $this->reservationModel = new ReservationModel();
    }
    
    public function dashboardAction() {
        require_once __DIR__ . '/views/admin/dashboard.php';
    }
    
    public function clientListAction() {
        $this->clientController->listAction();
    }
    
    public function clientAddAction() {
        $this->clientController->addAction();
    }
    
    public function clientCreateAction() {
        $this->clientController->createAction();
    }
    
    public function clientEditAction($id) {
        $this->clientController->editAction($id);
    }
    
    public function clientUpdateAction($id) {
        $this->clientController->updateAction($id);
    }
    
    public function clientDeleteAction($id) {
        $this->clientController->deleteAction($id);
    }
    
    public function vehiculeListAction() {
        $this->vehiculeController->listAction();
    }
    
    public function vehiculeAddAction() {
        $this->vehiculeController->addAction();
    }
    
    public function vehiculeCreateAction() {
        $this->vehiculeController->createAction();
    }
    
    public function vehiculeEditAction($id) {
        $this->vehiculeController->editAction($id);
    }
    
    public function vehiculeUpdateAction($id) {
        $this->vehiculeController->updateAction($id);
    }
    
    public function vehiculeDeleteAction($id) {
        $this->vehiculeController->deleteAction($id);
    }
    
    public function voyageListAction() {
        $this->voyageController->listAction();
    }
    
    public function voyageAddAction() {
        $this->voyageController->addAction();
    }
    
    public function voyageCreateAction() {
        $this->voyageController->createAction();
    }
    
    public function voyageDeleteAction($id) {
        $this->voyageController->deleteAction($id);
    }
    
    public function reservationListAction() {
        $reservations = $this->reservationModel->getAllReservations();
        $pageTitle = "Gestion des Réservations";
        $content = __DIR__ . '/views/admin/reservation_liste.php';
        include __DIR__ . '/views/admin/layout.php';
    }
}
?>
