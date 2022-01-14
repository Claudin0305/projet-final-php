<?php

use App\Dao\AnneeAcademiqueDao;
use App\Dao\CoursDao;
use App\Dao\EtudiantDao;

session_start();
if (isset($_SESSION['note'])) {
    extract($_SESSION['note']);
}
if (isset($_SESSION['note_error'])) {
    extract($_SESSION['note_error']);
    var_dump($_SESSION['note_error']);
}

if (isset($_SESSION['onNote'])) {
    extract($_SESSION['onNote']);
}

$sessions = [
    "-------------------" => "-------------------",
    "Session 1" => 'S1',
    "Session 2" => 'S2'
];
$etudiants = new EtudiantDao();
$cours = new CoursDao();
$annees = new AnneeAcademiqueDao();

$firstTitle = 'Note';

?>
<div class="formulaire">
    <form action="<?= (isset($id) && !empty($id)) ? '/note/update' : '/note/insert' ?>" method="post">
        <input type="hidden" name="id" value="<?= $id ?? '' ?>">
        <div class="header">
            <h2>Note</h2>
        </div>
        <div class="flex-form">
            <div class="grid grid-2">
                <div class="form-control">
                    <label for="session">choisir la session<?= isset($e_session) ? "(<span class='danger small'>$e_session</span>)" : '' ?></label>
                    <select name="session" id="session">
                        <?php foreach ($sessions as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= (isset($session) && $session == $value) ? 'selected="selected"' : '' ?>><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="annee">Choisir l'année academique<?= isset($e_annee) ? "(<span class='danger small'>$e_annee</span>)" : '' ?></label>
                    <select name="annee" id="annee">
                        <option value="-------------------">-------------------</option>
                        <?php foreach ($annees->getAll() as $a) : ?>
                            <option value="<?= $a->getId() ?>" <?= (isset($annee) && $annee == $a->getId()) ? 'selected="selected"' : '' ?>><?= $a->getAnneeAcademique() ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="code_cours">Choisir le code du cours<?= isset($e_code_cours) ? "(<span class='danger small'>$e_code_cours</span>)" : '' ?></label>
                    <select name="code_cours" id="code_cours">
                        <option value="-------------------">-------------------</option>
                        <?php foreach ($cours->getAll() as $c) : ?>
                            <option value="<?= $c->getId() ?>" <?= (isset($code_cours) && $code_cours == $c->getId()) ? 'selected="selected"' : '' ?>><?= $c->getCode() ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="code_etudiant">Choisir le code de l'étudiant<?= isset($e_code_etudiant) ? "(<span class='danger small'>$e_code_etudiant</span>)" : '' ?></label>
                    <select name="code_etudiant" id="code_etudiant">
                        <option value="-------------------">-------------------</option>
                        <?php foreach ($etudiants->getAll() as $etudiant) : ?>
                            <option value="<?= $etudiant->getId() ?>" <?= (isset($code_etudiant) && $code_etudiant == $etudiant->getId()) ? 'selected="selected"' : '' ?>><?= $etudiant->getCode() ?></option>

                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="note">Note<?= isset($e_note) ? "(<span class='danger small'>$e_note</span>)" : '' ?></label>
                    <input type="number" value="<?= $note ?? '' ?>" name="note" id="note" placeholder="Saisir la note">
                </div>
            </div>
        </div>
        <div class="btn-group">
            <input type="submit" value="Enregistrer" class="btn btn-primary">
        </div>
    </form>
</div>