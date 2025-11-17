<?php
/**
 * Vue Dashboard Admin - Aperçu des statistiques
 */
$pageTitle = "📊 Tableau de Bord";
?>

<div class="card">
    <div class="card-header">
        <h2>Bienvenue dans votre Dashboard</h2>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <!-- Statistique Clients -->
            <div class="card" style="text-align: center;">
                <div style="font-size: 32px; color: #007BFF; margin-bottom: 10px;">👥</div>
                <h3 style="color: #007BFF; margin: 10px 0;">Clients</h3>
                <p style="font-size: 24px; font-weight: bold; color: #333;">
                    <?php 
                    require_once '/models/ClientModel.php';
                    $clientModel = new ClientModel();
                    $clients = $clientModel->getAllClients();
                    echo count($clients);
                    ?>
                </p>
            </div>

            <!-- Statistique Véhicules -->
            <div class="card" style="text-align: center;">
                <div style="font-size: 32px; color: #28a745; margin-bottom: 10px;">🚌</div>
                <h3 style="color: #28a745; margin: 10px 0;">Véhicules</h3>
                <p style="font-size: 24px; font-weight: bold; color: #333;">
                    <?php 
                    require_once '/models/VehiculeModel.php';
                    $vehiculeModel = new VehiculeModel();
                    $vehicules = $vehiculeModel->getAllVehicules();
                    echo count($vehicules);
                    ?>
                </p>
            </div>

            <!-- Statistique Voyages -->
            <div class="card" style="text-align: center;">
                <div style="font-size: 32px; color: #ffc107; margin-bottom: 10px;">✈️</div>
                <h3 style="color: #ffc107; margin: 10px 0;">Voyages</h3>
                <p style="font-size: 24px; font-weight: bold; color: #333;">
                    <?php 
                    require_once '/models/VoyageModel.php';
                    $voyageModel = new VoyageModel();
                    $voyages = $voyageModel->getAllVoyages();
                    echo count($voyages);
                    ?>
                </p>
            </div>

            <!-- Statistique Réservations -->
            <div class="card" style="text-align: center;">
                <div style="font-size: 32px; color: #17a2b8; margin-bottom: 10px;">🎫</div>
                <h3 style="color: #17a2b8; margin: 10px 0;">Réservations</h3>
                <p style="font-size: 24px; font-weight: bold; color: #333;">
                    <?php 
                    require_once '/models/ReservationModel.php';
                    $reservationModel = new ReservationModel();
                    $reservations = $reservationModel->getAllReservations();
                    echo count($reservations);
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>
