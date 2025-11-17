<?php
/**
 * Vue - Liste des véhicules
 */
?>

<div class="card">
    <div class="card-header">
        <h2>Liste des Véhicules</h2>
        <a href="/admin/vehicule/add" class="btn btn-primary">➕ Ajouter un Véhicule</a>
    </div>
    <div class="card-body">
        <?php if (empty($vehicules)): ?>
            <p style="text-align: center; padding: 40px; color: #999;">
                Aucun véhicule trouvé.
            </p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Immatriculation</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Sièges</th>
                        <th>Année</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vehicules as $vehicule): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($vehicule['id_vehicule']); ?></td>
                            <td><strong><?php echo htmlspecialchars($vehicule['immatriculation']); ?></strong></td>
                            <td><?php echo htmlspecialchars($vehicule['marque']); ?></td>
                            <td><?php echo htmlspecialchars($vehicule['modele'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($vehicule['nombre_sieges']); ?></td>
                            <td><?php echo htmlspecialchars($vehicule['annee_acquisition'] ?? 'N/A'); ?></td>
                            <td>
                                <span style="
                                    padding: 5px 10px;
                                    border-radius: 4px;
                                    font-size: 12px;
                                    font-weight: bold;
                                    <?php
                                    if ($vehicule['statut'] === 'disponible') {
                                        echo 'background-color: #d4edda; color: #155724;';
                                    } elseif ($vehicule['statut'] === 'en_voyage') {
                                        echo 'background-color: #fff3cd; color: #856404;';
                                    } else {
                                        echo 'background-color: #f8d7da; color: #721c24;';
                                    }
                                    ?>
                                ">
                                    <?php echo ucfirst(str_replace('_', ' ', $vehicule['statut'])); ?>
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="/admin/vehicule/edit/<?php echo $vehicule['id_vehicule']; ?>" class="btn btn-secondary btn-small">✏️ Modifier</a>
                                    <a href="/admin/vehicule/delete/<?php echo $vehicule['id_vehicule']; ?>" class="btn btn-danger btn-small" onclick="return confirm('Êtes-vous sûr?')">🗑️ Supprimer</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
