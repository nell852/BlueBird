<?php
/**
 * Vue - Formulaire de modification d'un client
 */
?>

<div class="card">
    <div class="card-header">
        <h2>Modifier le Client</h2>
    </div>
    <div class="card-body">
        <form action="/admin/client/update/<?php echo $client['id_client']; ?>" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($client['nom']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($client['prenom']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" disabled>
                    <small style="color: #999;">L'email ne peut pas être modifié</small>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" value="<?php echo htmlspecialchars($client['telephone'] ?? ''); ?>">
                </div>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">✅ Enregistrer les Modifications</button>
                <a href="/admin/clients" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
