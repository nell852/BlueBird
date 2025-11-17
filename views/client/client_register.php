<?php
/**
 * Vue - Formulaire d'inscription client
 */
$pageTitle = "Inscription";
?>

<div style="max-width: 500px; margin: 50px auto;">
    <div class="card">
        <div class="card-header">
            <h2>Créer un Compte</h2>
        </div>
        <div class="card-body">
            <form action="index.php?action=client&subaction=register" method="POST">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" required>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe *</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirmer le mot de passe *</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">✅ S'inscrire</button>
            </form>

            <p style="text-align: center; margin-top: 20px;">
                Vous avez déjà un compte? <a href="index.php?action=client&subaction=login" style="color: #007BFF;">Connectez-vous</a>
            </p>
        </div>
    </div>
</div>
