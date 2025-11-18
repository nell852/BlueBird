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
    <link rel="stylesheet" href="/public/css/modern-style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="/public/js/map.js" defer></script>
    <style>
        .custom-bus-marker, .custom-city-marker {
            background: transparent;
            border: none;
        }
        .bus-marker, .city-marker {
            background: white;
            padding: 8px 12px;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
        }
        .bus-icon, .city-icon {
            font-size: 20px;
        }
        .map-popup h3 {
            margin-bottom: 12px;
            color: #667eea;
        }
        .map-popup p {
            margin: 8px 0;
            font-size: 14px;
        }
        
    </style>
</head>
<body>
    <!-- NAVBAR CLIENT -->
    <div class="client-header">
        <div class="client-nav">
            <h1>🐦 Blue Bird Express</h1>
            <div class="client-nav-links">
                <a href="/client/voyages">Voyages</a>
                <a href="/client/reservations">Mes Réservations</a>
                <?php if (isset($_SESSION['client_id'])): ?>
                    <div class="user-avatar"><?php echo strtoupper(substr($_SESSION['client_prenom'] ?? 'C', 0, 1)); ?></div>
                    <a href="/logout" style="background-color: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 8px;">Déconnexion</a>
                <?php else: ?>
                    <a href="/client/login">Connexion</a>
                    <a href="/client/register" style="background-color: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 8px;">Inscription</a>
                <?php endif; ?>
            </div>
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
