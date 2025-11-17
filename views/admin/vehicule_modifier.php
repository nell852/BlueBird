<?php
/**
 * Vue - Formulaire de modification d'un véhicule
 */
?>

<div class="card">
    <div class="card-header">
        <h2>Modifier le Véhicule</h2>
    </div>
    <div class="card-body">
        <form action="/admin/vehicule/update/<?php echo $vehicule['id_vehicule']; ?>" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="immatriculation">Immatriculation</label>
                    <input type="text" id="immatriculation" name="immatriculation" value="<?php echo htmlspecialchars($vehicule['immatriculation']); ?>" disabled>
                    <small style="color: #999;">L'immatriculation ne peut pas être modifiée</small>
                </div>
                <div class="form-group">
                    <label for="marque">Marque *</label>
                    <input type="text" id="marque" name="marque" value="<?php echo htmlspecialchars($vehicule['marque']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="modele">Modèle</label>
                    <input type="text" id="modele" name="modele" value="<?php echo htmlspecialchars($vehicule['modele'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="nombre_sieges">Nombre de Sièges *</label>
                    <input type="number" id="nombre_sieges" name="nombre_sieges" value="<?php echo htmlspecialchars($vehicule['nombre_sieges']); ?>" min="1" required>
                </div>
            </div>

            <div class="form-group">
                <label for="statut">Statut *</label>
                <select id="statut" name="statut" required>
                    <option value="disponible" <?php echo $vehicule['statut'] === 'disponible' ? 'selected' : ''; ?>>Disponible</option>
                    <option value="en_voyage" <?php echo $vehicule['statut'] === 'en_voyage' ? 'selected' : ''; ?>>En Voyage</option>
                    <option value="en_maintenance" <?php echo $vehicule['statut'] === 'en_maintenance' ? 'selected' : ''; ?>>En Maintenance</option>
                </select>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">✅ Enregistrer les Modifications</button>
                <a href="/admin/vehicules" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
