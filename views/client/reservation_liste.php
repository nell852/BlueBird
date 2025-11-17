<?php
/**
 * Vue - Liste des réservations du client
 */
$pageTitle = "Mes Réservations";
?>

<div style="margin-top: 30px;">
    <div class="card">
        <div class="card-header">
            <h2>Mes Réservations</h2>
        </div>
        <div class="card-body">
            <?php if (empty($reservations)): ?>
                <p style="text-align: center; padding: 40px; color: #999;">
                    Vous n'avez aucune réservation. <a href="/client/voyages" style="color: #007BFF;">Rechercher un voyage</a>
                </p>
            <?php else: ?>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 20px;">
                    <?php foreach ($reservations as $reservation): ?>
                        <div class="card" style="border-left: 4px solid #007BFF;">
                            <div style="padding: 15px;">
                                <h3 style="color: #007BFF; margin-top: 0;">
                                    <?php echo htmlspecialchars($reservation['ville_depart'] ?? 'N/A'); ?> → 
                                    <?php echo htmlspecialchars($reservation['ville_arrivee'] ?? 'N/A'); ?>
                                </h3>
                                
                                <p><strong>N° Réservation:</strong> <?php echo htmlspecialchars($reservation['id_reservation']); ?></p>
                                <p><strong>Siège:</strong> <?php echo htmlspecialchars($reservation['siege_assigne']); ?></p>
                                <p><strong>Départ:</strong> <?php echo htmlspecialchars($reservation['date_heure_depart']); ?></p>
                                <p><strong>Tarif:</strong> <?php echo number_format($reservation['tarif'], 0, ',', ' '); ?> FCFA</p>
                                
                                <p style="margin-top: 10px;">
                                    <strong>Statut:</strong> 
                                    <span style="
                                        padding: 5px 10px;
                                        border-radius: 4px;
                                        font-weight: bold;
                                        <?php
                                        if ($reservation['statut'] === 'confirmée') {
                                            echo 'background-color: #d4edda; color: #155724;';
                                        } elseif ($reservation['statut'] === 'annulée') {
                                            echo 'background-color: #f8d7da; color: #721c24;';
                                        } else {
                                            echo 'background-color: #e2e3e5; color: #383d41;';
                                        }
                                        ?>
                                    ">
                                        <?php echo ucfirst($reservation['statut']); ?>
                                    </span>
                                </p>
                                
                                <?php if ($reservation['statut'] === 'confirmée'): ?>
                                    <form action="/client/reservation/cancel/<?php echo $reservation['id_reservation']; ?>" method="GET" style="margin-top: 15px;">
                                        <button type="submit" class="btn btn-danger" style="width: 100%;" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation?');">❌ Annuler</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
