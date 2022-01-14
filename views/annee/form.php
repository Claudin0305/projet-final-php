<?php
session_start();
if (isset($_SESSION['annee'])) {
    extract($_SESSION['annee']);
}
if (isset($_SESSION['annee_error'])) {
    extract($_SESSION['annee_error']);
    var_dump($_SESSION['annee_error']);
}

if(isset($_SESSION['onYear'])){
    extract($_SESSION['onYear']);
}
$etats = [
    "-------------------" => "-------------------",
    "En cours" => 'O',
    "Fermée" => 'F'
];
$firstTitle = 'Année Academique';
?>
<div class="formulaire">
    <form action="<?= (isset($id) && !empty($id)) ?'/annee/update': '/annee/insert'?>" method="post">
        <input type="hidden" name="id" value="<?= $id ?? '' ?>">
        <div class="header">
            <h2>Année Academique</h2>
        </div>
        <div class="flex-form">
            <div class="grid grid-3">
                <div class="form-control">
                    <label for="anneeDebut">Année Debut <?= isset($e_annee_debut) ? "(<span class='danger small'>$e_annee_debut</span>)" : '' ?></label>
                    <input type="number" value="<?= $anneeDebut ?? '' ?>" name="anneeDebut" id="anneeDebut" placeholder="Saisir l'année debut">
                </div>
                <div class="form-control">
                    <label for="anneeFin">Année Fin<?= isset($e_annee_fin) ? "(<span class='danger small'>$e_annee_fin</span>)" : '' ?></label>
                    <input type="number" value="<?= $anneeFin ?? '' ?>" name="anneeFin" id="anneeFin" placeholder="Saisir l'année de fin">
                </div>
                <div class="form-control">
                    <label for="dateDebut">Date Debut<?= isset($e_date_debut) ? "(<span class='danger small'>$e_date_debut</span>)" : '' ?></label>
                    <input type="date" value="<?= $dateDebut ?? '' ?>" name="dateDebut" id="dateDebut">
                </div>
                <div class="form-control">
                    <label for="dateFin">Date Fin<?= isset($e_date_fin) ? "(<span class='danger small'>$e_date_fin</span>)" : '' ?></label>
                    <input type="date" value="<?= $dateFin ?? '' ?>" name="dateFin" id="dateFin">
                </div>
                <div class="form-control">
                    <label for="etat">Etat<?= isset($e_etat) ? "(<span class='danger small'>$e_etat</span>)" : '' ?></label>
                    <select name="etat" id="etat">
                        <?php foreach ($etats as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= (isset($etat) && $etat === $value) ? 'selected="selected"' : '' ?>><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="btn-group">
            <input type="submit" value="Enregistrer" class="btn btn-primary">
        </div>
    </form>
</div>