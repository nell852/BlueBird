<?php
/**
 * Layout principal du front-office client
 */

function url($path) {
    return '/' . ltrim($path, '/');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Bird Express - Réservation de Voyages</title>
    <!-- Utiliser un chemin absolu pour le CSS -->
    <link rel="stylesheet" href="/public/css/style.css">
    <style>
        .client-navbar {
            background: linear-gradient(135deg, #007BFF 0%, #0056b3 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .client-navbar h1 {
            margin: 0;
            font-size: 24px;
        }
        
        .navbar-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        
        .navbar-links a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .navbar-links a:hover {
            opacity: 0.8;
            text-decoration: underline;
        }
        
        .client-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
        }
    </style>
</head>
<body>
    <!-- NAVBAR CLIENT -->
    <div class="client-navbar">
        <h1>🐦 Blue Bird Express</h1>
        <div class="navbar-links">
            <a href="/index.php?action=client&subaction=voyages">Voyages</a>
            <a href="/index.php?action=client&subaction=reservations">Mes Réservations</a>
            <?php if (isset($_SESSION['client_id'])): ?>
                <span><?php echo htmlspecialchars($_SESSION['client_prenom'] ?? 'Client'); ?></span>
                <a href="/index.php?action=logout" style="background-color: #dc3545; padding: 8px 15px; border-radius: 4px;">Déconnexion</a>
            <?php else: ?>
                <a href="/index.php?action=client&subaction=login">Connexion</a>
                <a href="/index.php?action=client&subaction=register" style="background-color: #28a745; padding: 8px 15px; border-radius: 4px;">Inscription</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- PAGE CONTENT -->
    <div class="client-container">
        <?php 
        // Affichage des messages d'alerte
        if (isset($_SESSION['message'])) {
            $type = $_SESSION['message_type'] ?? 'info';
            echo '<div class="alert alert-' . $type . '">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>
        <?php include $content; ?>
    </div>
</body>
</html>
