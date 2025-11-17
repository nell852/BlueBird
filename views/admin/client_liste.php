<?php
/**
 * Vue - Liste des clients avec actions
 */
?>

<div class="card">
    <div class="card-header">
        <h2>Liste des Clients</h2>
        <a href="/admin/client/add" class="btn btn-primary">➕ Ajouter un Client</a>
    </div>
    <div class="card-body">
        <?php if (empty($clients)): ?>
            <p style="text-align: center; padding: 40px; color: #999;">
                Aucun client trouvé.
            </p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Date d'inscription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($client['id_client']); ?></td>
                            <td><?php echo htmlspecialchars($client['nom']); ?></td>
                            <td><?php echo htmlspecialchars($client['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($client['email']); ?></td>
                            <td><?php echo htmlspecialchars($client['telephone'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($client['date_inscription']); ?></td>
                            <td>
                                <div class="table-actions">
                                    <a href="/admin/client/edit/<?php echo $client['id_client']; ?>" class="btn btn-secondary btn-small">✏️ Modifier</a>
                                    <a href="/admin/client/delete/<?php echo $client['id_client']; ?>" class="btn btn-danger btn-small" onclick="return confirm('Êtes-vous sûr?')">🗑️ Supprimer</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
