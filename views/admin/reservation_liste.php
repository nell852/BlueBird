<?php
/**
 * Vue Admin - Liste des réservations (Dashboard)
 */
?>

<div class="card">
    <div class="card-header">
        <h2>Gestion des Réservations</h2>
    </div>
    <div class="card-body">
        <?php if (empty($reservations)): ?>
            <p style="text-align: center; padding: 40px; color: #999;">
                Aucune réservation pour le moment.
            </p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Email</th>
                        <th>Trajet</th>
                        <th>Siège</th>
                        <th>Départ</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['id_reservation']); ?></td>
                            <td><?php echo htmlspecialchars(($reservation['prenom'] ?? '') . ' ' . ($reservation['nom'] ?? '')); ?></td>
                            <td><?php echo htmlspecialchars($reservation['email'] ?? 'N/A'); ?></td>
                            <td>
                                <?php echo htmlspecialchars($reservation['ville_depart'] ?? 'N/A'); ?> → 
                                <?php echo htmlspecialchars($reservation['ville_arrivee'] ?? 'N/A'); ?>
                            </td>
                            <td><?php echo htmlspecialchars($reservation['siege_assigne']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['date_heure_depart']); ?></td>
                            <td>
                                <span style="
                                    padding: 5px 10px;
                                    border-radius: 4px;
                                    font-size: 12px;
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
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
