<?php
/**
 * Vue - Formulaire de connexion client
 */
$pageTitle = "Connexion";
?>

<div style="max-width: 500px; margin: 50px auto;">
    <div class="card">
        <div class="card-header">
            <h2>Connexion à votre Compte</h2>
        </div>
        <div class="card-body">
            <form action="/client/login" method="POST">
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe *</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">🔓 Se Connecter</button>
            </form>

            <p style="text-align: center; margin-top: 20px;">
                Pas encore de compte? <a href="/client/register" style="color: #007BFF;">Inscrivez-vous</a>
            </p>
        </div>
    </div>
</div>
