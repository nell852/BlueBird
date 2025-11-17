<?php
/**
 * Vue - Confirmation de réservation
 */
$pageTitle = "Confirmer ma Réservation";
?>

<div style="max-width: 600px; margin: 50px auto;">
    <div class="card">
        <div class="card-header">
            <h2>Confirmer votre Réservation</h2>
        </div>
        <div class="card-body">
            <div style="margin-bottom: 30px; padding: 20px; background-color: #f0f8ff; border-radius: 8px;">
                <h3 style="color: #007BFF; margin-top: 0;">Détails du Voyage</h3>
                <p><strong>Trajet:</strong> <?php echo htmlspecialchars($voyage['ville_depart_nom'] ?? 'N/A'); ?> → <?php echo htmlspecialchars($voyage['ville_arrivee_nom'] ?? 'N/A'); ?></p>
                <p><strong>Départ:</strong> <?php echo htmlspecialchars($voyage['date_heure_depart']); ?></p>
                <p><strong>Véhicule:</strong> <?php echo htmlspecialchars($voyage['marque'] ?? 'N/A'); ?></p>
                <p><strong>Chauffeur:</strong> <?php echo htmlspecialchars(($voyage['prenom'] ?? '') . ' ' . ($voyage['nom'] ?? '')); ?></p>
                <p style="font-size: 18px; color: #007BFF; font-weight: bold;">
                    <strong>Prix:</strong> <?php echo number_format($voyage['tarif'], 0, ',', ' '); ?> FCFA
                </p>
            </div>

            <form action="/client/reservation/create" method="POST">
                <input type="hidden" name="id_voyage" value="<?php echo $voyage['id_voyage']; ?>">
                
                <div class="form-group">
                    <label for="siege_assigne">Sélectionnez votre Siège *</label>
                    <select id="siege_assigne" name="siege_assigne" required>
                        <option value="">-- Choisissez un siège --</option>
                        <?php foreach ($sieges as $siege): ?>
                            <option value="<?php echo $siege; ?>">Siège <?php echo $siege; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 30px;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">✅ Confirmer la Réservation</button>
                    <a href="/client/voyages" class="btn btn-secondary" style="flex: 1; text-align: center;">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>
