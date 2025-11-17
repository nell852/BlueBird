<?php
/**
 * Vue - Liste des voyages
 */
?>

<div class="card">
    <div class="card-header">
        <h2>Liste des Voyages</h2>
        <a href="/admin/voyage/add" class="btn btn-primary">➕ Ajouter un Voyage</a>
    </div>
    <div class="card-body">
        <?php if (empty($voyages)): ?>
            <p style="text-align: center; padding: 40px; color: #999;">
                Aucun voyage planifié.
            </p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Véhicule</th>
                        <th>Chauffeur</th>
                        <th>Trajet</th>
                        <th>Départ</th>
                        <th>Tarif (FCFA)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($voyages as $voyage): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($voyage['id_voyage']); ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($voyage['marque'] ?? 'N/A'); ?></strong><br>
                                <small style="color: #999;"><?php echo htmlspecialchars($voyage['immatriculation'] ?? 'N/A'); ?></small>
                            </td>
                            <td><?php echo htmlspecialchars(($voyage['prenom'] ?? '') . ' ' . ($voyage['nom'] ?? '')); ?></td>
                            <td>
                                <?php echo htmlspecialchars($voyage['ville_depart_nom'] ?? 'N/A'); ?> → 
                                <?php echo htmlspecialchars($voyage['ville_arrivee_nom'] ?? 'N/A'); ?>
                            </td>
                            <td><?php echo htmlspecialchars($voyage['date_heure_depart']); ?></td>
                            <td><?php echo number_format($voyage['tarif'], 0, ',', ' '); ?></td>
                            <td>
                                <div class="table-actions">
                                    <a href="/admin/voyage/delete/<?php echo $voyage['id_voyage']; ?>" class="btn btn-danger btn-small" onclick="return confirm('Êtes-vous sûr?')">🗑️ Supprimer</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
