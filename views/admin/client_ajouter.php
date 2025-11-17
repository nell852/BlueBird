<?php
/**
 * Vue - Formulaire d'ajout d'un client
 */
?>

<div class="card">
    <div class="card-header">
        <h2>Ajouter un Nouveau Client</h2>
    </div>
    <div class="card-body">
        <form action="/admin/client/create" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone">
                </div>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe *</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">✅ Créer le Client</button>
                <a href="/admin/clients" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
