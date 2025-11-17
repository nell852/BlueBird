<?php
/**
 * Vue - Formulaire d'ajout d'un voyage
 */
?>

<div class="card">
    <div class="card-header">
        <h2>Créer un Nouveau Voyage</h2>
    </div>
    <div class="card-body">
        <form action="/admin/voyage/create" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="id_vehicule">Véhicule *</label>
                    <select id="id_vehicule" name="id_vehicule" required>
                        <option value="">-- Sélectionnez un véhicule --</option>
                        <?php foreach ($vehicules as $vehicule): ?>
                            <option value="<?php echo $vehicule['id_vehicule']; ?>">
                                <?php echo htmlspecialchars($vehicule['marque'] . ' - ' . $vehicule['immatriculation'] . ' (' . $vehicule['nombre_sieges'] . ' sièges)'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_chauffeur">Chauffeur *</label>
                    <select id="id_chauffeur" name="id_chauffeur" required>
                        <option value="">-- Sélectionnez un chauffeur --</option>
                        <?php foreach ($chauffeurs as $chauffeur): ?>
                            <option value="<?php echo $chauffeur['id_employe']; ?>">
                                <?php echo htmlspecialchars($chauffeur['prenom'] . ' ' . $chauffeur['nom']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="ville_depart">Ville de Départ *</label>
                    <select id="ville_depart" name="ville_depart" required>
                        <option value="">-- Sélectionnez la ville de départ --</option>
                        <?php foreach ($villes as $ville): ?>
                            <option value="<?php echo $ville['id_ville']; ?>">
                                <?php echo htmlspecialchars($ville['nom_ville']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ville_arrivee">Ville d'Arrivée *</label>
                    <select id="ville_arrivee" name="ville_arrivee" required>
                        <option value="">-- Sélectionnez la ville d'arrivée --</option>
                        <?php foreach ($villes as $ville): ?>
                            <option value="<?php echo $ville['id_ville']; ?>">
                                <?php echo htmlspecialchars($ville['nom_ville']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="date_heure_depart">Date et Heure de Départ *</label>
                    <input type="datetime-local" id="date_heure_depart" name="date_heure_depart" required>
                </div>
                <div class="form-group">
                    <label for="tarif">Tarif (FCFA) *</label>
                    <input type="number" id="tarif" name="tarif" min="0" step="100" placeholder="ex: 25000" required>
                </div>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">✅ Créer le Voyage</button>
                <a href="/admin/voyages" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
