<?php
/**
 * Vue - Recherche de voyages
 */
$pageTitle = "Rechercher un Voyage";
?>

<div style="margin-top: 30px;">
    <!-- FORMULAIRE DE RECHERCHE -->
    <div class="card">
        <div class="card-header">
            <h2>Rechercher un Voyage</h2>
        </div>
        <div class="card-body">
            <form action="/client/voyages" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="ville_depart">Ville de Départ</label>
                        <select id="ville_depart" name="ville_depart">
                            <option value="">-- Toutes les villes --</option>
                            <?php foreach ($villes as $ville): ?>
                                <option value="<?php echo $ville['id_ville']; ?>" 
                                        <?php echo ($searchParams['ville_depart'] ?? '') == $ville['id_ville'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($ville['nom_ville']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ville_arrivee">Ville d'Arrivée</label>
                        <select id="ville_arrivee" name="ville_arrivee">
                            <option value="">-- Toutes les villes --</option>
                            <?php foreach ($villes as $ville): ?>
                                <option value="<?php echo $ville['id_ville']; ?>" 
                                        <?php echo ($searchParams['ville_arrivee'] ?? '') == $ville['id_ville'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($ville['nom_ville']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" value="<?php echo $searchParams['date'] ?? ''; ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">🔍 Rechercher</button>
            </form>
        </div>
    </div>

    <!-- RÉSULTATS DE RECHERCHE -->
    <div class="card" style="margin-top: 30px;">
        <div class="card-header">
            <h2>Résultats (<?php echo count($voyages); ?> voyage(s) trouvé(s))</h2>
        </div>
        <div class="card-body">
            <?php if (empty($voyages)): ?>
                <p style="text-align: center; padding: 40px; color: #999;">
                    Aucun voyage disponible selon vos critères de recherche.
                </p>
            <?php else: ?>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                    <?php foreach ($voyages as $voyage): ?>
                        <div class="card" style="border: 2px solid #007BFF;">
                            <div style="padding: 15px;">
                                <h3 style="color: #007BFF; margin-top: 0;">
                                    <?php echo htmlspecialchars($voyage['ville_depart_nom'] ?? 'N/A'); ?> → 
                                    <?php echo htmlspecialchars($voyage['ville_arrivee_nom'] ?? 'N/A'); ?>
                                </h3>
                                
                                <p><strong>Départ:</strong> <?php echo htmlspecialchars($voyage['date_heure_depart']); ?></p>
                                <p><strong>Véhicule:</strong> <?php echo htmlspecialchars($voyage['marque'] ?? 'N/A'); ?> (<?php echo htmlspecialchars($voyage['nombre_sieges']); ?> sièges)</p>
                                <p><strong>Chauffeur:</strong> <?php echo htmlspecialchars(($voyage['prenom'] ?? '') . ' ' . ($voyage['nom'] ?? '')); ?></p>
                                <p style="font-size: 18px; color: #007BFF; font-weight: bold;">
                                    Tarif: <?php echo number_format($voyage['tarif'], 0, ',', ' '); ?> FCFA
                                </p>
                                
                                <form action="/client/reservation/confirm/<?php echo $voyage['id_voyage']; ?>" method="GET">
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">🎫 Réserver</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
