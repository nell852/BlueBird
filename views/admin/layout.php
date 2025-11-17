<?php
/**
 * Layout principal du back-office admin
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Bird Express - Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="admin-container">
        <!-- SIDEBAR NAVIGATION -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>🐦 Blue Bird Express</h2>
            </div>
            <ul class="sidebar-nav">
                <li>
                    <a href="index.php?action=admin&subaction=dashboard" class="<?php echo ($_GET['subaction'] ?? '') === 'dashboard' ? 'active' : ''; ?>">
                        📊 Dashboard
                    </a>
                </li>
                <li>
                    <a href="index.php?action=admin&subaction=clients" class="<?php echo ($_GET['subaction'] ?? '') === 'clients' ? 'active' : ''; ?>">
                        👥 Clients
                    </a>
                </li>
                <li>
                    <a href="index.php?action=admin&subaction=vehicules" class="<?php echo ($_GET['subaction'] ?? '') === 'vehicules' ? 'active' : ''; ?>">
                        🚌 Véhicules
                    </a>
                </li>
                <li>
                    <a href="index.php?action=admin&subaction=voyages" class="<?php echo ($_GET['subaction'] ?? '') === 'voyages' ? 'active' : ''; ?>">
                        ✈️ Voyages
                    </a>
                </li>
                <li>
                    <a href="index.php?action=admin&subaction=reservations" class="<?php echo ($_GET['subaction'] ?? '') === 'reservations' ? 'active' : ''; ?>">
                        🎫 Réservations
                    </a>
                </li>
                <li>
                    <a href="index.php?action=logout">
                        🚪 Déconnexion
                    </a>
                </li>
            </ul>
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <!-- TOP BAR -->
            <div class="top-bar">
                <h1><?php echo $pageTitle ?? 'Blue Bird Express'; ?></h1>
                <div class="user-info">
                    <span>Admin</span>
                </div>
            </div>

            <!-- PAGE CONTENT -->
            <div class="page-content">
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
        </div>
    </div>
</body>
</html>
