<?php
/**
 * Vue - Formulaire d'ajout d'un véhicule
 */
?>

<div class="card">
    <div class="card-header">
        <h2>Ajouter un Nouveau Véhicule</h2>
    </div>
    <div class="card-body">
        <form action="/admin/vehicule/create" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="immatriculation">Immatriculation *</label>
                    <input type="text" id="immatriculation" name="immatriculation" placeholder="AA-123-BB" required>
                </div>
                <div class="form-group">
                    <label for="marque">Marque *</label>
                    <input type="text" id="marque" name="marque" placeholder="ex: Mercedes, Volvo" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="modele">Modèle</label>
                    <input type="text" id="modele" name="modele" placeholder="ex: Sprinter">
                </div>
                <div class="form-group">
                    <label for="nombre_sieges">Nombre de Sièges *</label>
                    <input type="number" id="nombre_sieges" name="nombre_sieges" min="1" value="50" required>
                </div>
            </div>

            <div class="form-group">
                <label for="annee_acquisition">Année d'Acquisition</label>
                <input type="number" id="annee_acquisition" name="annee_acquisition" min="2000" value="<?php echo date('Y'); ?>">
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">✅ Créer le Véhicule</button>
                <a href="/admin/vehicules" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
