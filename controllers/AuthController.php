<?php
require_once __DIR__ . '/../models/ClientModel.php';

/**
 * Contrôleur pour l'authentification client
 */
class AuthController {
    private ClientModel $clientModel;
    
    public function __construct() {
        $this->clientModel = new ClientModel();
    }
    
    /**
     * Affiche le formulaire d'inscription
     */
    public function registerFormAction() {
        $pageTitle = "Inscription";
        $content = __DIR__ . '/../views/client/client_register.php';
        include __DIR__ . '/../views/client/layout.php';
    }
    
    /**
     * Traite l'inscription d'un client
     */
    public function registerAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $email = $_POST['email'] ?? '';
            $telephone = $_POST['telephone'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            
            // Validation
            if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
                $_SESSION['message'] = 'Veuillez remplir tous les champs obligatoires.';
                $_SESSION['message_type'] = 'error';
                redirect('client.register');
            }
            
            if ($password !== $confirm_password) {
                $_SESSION['message'] = 'Les mots de passe ne correspondent pas.';
                $_SESSION['message_type'] = 'error';
                redirect('client.register');
            }
            
            if (strlen($password) < 6) {
                $_SESSION['message'] = 'Le mot de passe doit contenir au moins 6 caractères.';
                $_SESSION['message_type'] = 'error';
                redirect('client.register');
            }
            
            if ($this->clientModel->register($nom, $prenom, $email, $password, $telephone)) {
                $_SESSION['message'] = 'Inscription réussie! Veuillez vous connecter.';
                $_SESSION['message_type'] = 'success';
                redirect('client.login');
            } else {
                $_SESSION['message'] = 'Cet email est déjà utilisé ou une erreur est survenue.';
                $_SESSION['message_type'] = 'error';
                redirect('client.register');
            }
        }
    }
    
    /**
     * Affiche le formulaire de connexion
     */
    public function loginFormAction() {
        $pageTitle = "Connexion";
        $content = __DIR__ . '/../views/client/client_login.php';
        include __DIR__ . '/../views/client/layout.php';
    }
    
    /**
     * Traite la connexion d'un client
     */
    public function loginAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if (empty($email) || empty($password)) {
                $_SESSION['message'] = 'Veuillez remplir l\'email et le mot de passe.';
                $_SESSION['message_type'] = 'error';
                redirect('client.login');
            }
            
            $client = $this->clientModel->login($email, $password);
            
            if ($client) {
                $_SESSION['client_id'] = $client['id_client'];
                $_SESSION['client_nom'] = $client['nom'];
                $_SESSION['client_prenom'] = $client['prenom'];
                $_SESSION['client_email'] = $client['email'];
                
                $_SESSION['message'] = 'Connexion réussie! Bienvenue ' . $client['prenom'] . '.';
                $_SESSION['message_type'] = 'success';
                redirect('client.voyages');
            } else {
                $_SESSION['message'] = 'Email ou mot de passe incorrect.';
                $_SESSION['message_type'] = 'error';
                redirect('client.login');
            }
        }
    }
    
    /**
     * Déconnexion du client
     */
    public function logoutAction() {
        session_destroy();
        $_SESSION = [];
        redirect('client.login');
    }
}
?>
