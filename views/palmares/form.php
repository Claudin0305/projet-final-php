<?php

use App\Dao\AnneeAcademiqueDao;
use App\Dao\CoursDao;
use App\Dao\EtudiantDao;

session_start();
$categories = [
    "-------------------",
    'Résultat',
    'Bulletin',
    'Relevé des notes'
];

$resultats = [
    "-------------------",

];

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
$filieres = [
    "-------------------",
    "Medecine", "Agronomie", "Génie",
    "Informatique", "Education bio",
    "Education chimie", "Education Math-phy",
    "Sociologie", "Psychologie", "Beaux-arts",
    "Environnement", "Travail social",
    "Psycho-éducation", "Amménagement",
    "Science politique"
];
$niveauM = ["-------------------", "EUF", "L1", "L2", "L3", "L4", "L5", "L6"];
$niveauG = ["-------------------", "EUF", "L1", "L2", "L3", "L4"];
$niv = ["-------------------", "EUF", "L1", "L2", "L3"];
$nivFiliere = [
    "Medecine" => $niveauM,
    "Agronomie" => $niveauG,
    "Génie" => $niveauG,
    "Informatique" => $niv,
    "Education bio" => $niv,
    "Education chimie" => $niv,
    "Education Math-phy" => $niv,
    "Sociologie" => $niv,
    "Psychologie" => $niv,
    "Beaux-arts" => $niv,
    "Environnement" => $niv,
    "Travail social" => $niv,
    "Psycho-éducation" => $niv,
    "Amménagement" => $niv,
    "Science politique" => $niv
];
$sessions = [
    "-------------------" => "-------------------",
    "Session 1" => 'S1',
    "Session 2" => 'S2'
];
$etudiants = new EtudiantDao();
$cours = new CoursDao();
$annees = new AnneeAcademiqueDao();

$firstTitle = 'Palmarès';

?>
<div class="formulaire">
    <form action="<?= (isset($id) && !empty($id)) ? '/note/update' : '/note/insert' ?>" method="post">
        <div class="header">
            <h2>Palmarès</h2>
        </div>
        <div class="flex-form">
            <div class="grid grid-2">
                <div class="form-control">
                    <label for="categories">choisir le type de résultat<?= isset($e_categorie) ? "(<span class='danger small'>$e_categorie</span>)" : '' ?></label>
                    <select name="categories" id="categories">
                        <?php foreach ($categories as $value) : ?>
                            <option value="<?= $value ?>" <?= (isset($categorie) && $categorie == $value) ? 'selected="selected"' : '' ?>><?= $value ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control resultat">
                    <label for="filiere">Choisir la filiere<?= isset($e_filiere) ? "(<span class='danger small'>$e_filiere</span>)" : '' ?></label>
                    <select name="filiere" id="filiere">
                        <?php foreach ($filieres as $value) : ?>
                            <option value="<?= $value ?>" <?= (isset($filiere) && $filiere === $value) ? 'selected="selected"' : '' ?>><?= $value ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control resultat">
                    <label for="niveau">Choisir le niveau<?= isset($e_niveau) ? "(<span class='danger small'>$e_niveau</span>)" : '' ?></label>
                    <select name="niveau" id="niveau">
                        <?php if (isset($id) && !empty($id) && isset($filiere) && !empty($filiere)) : ?>
                            <?php foreach ($nivFiliere[$filiere] as $niveauF) : ?>
                                <option value="<?= $niveauF ?>" <?= (isset($niveau) && $niveau === $niveauF) ? 'selected="selected"' : '' ?>><?= $niveauF ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form-control resultat">
                    <label for="session">choisir la session<?= isset($e_session) ? "(<span class='danger small'>$e_session</span>)" : '' ?></label>
                    <select name="session" id="session">
                        <?php foreach ($sessions as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= (isset($session) && $session == $value) ? 'selected="selected"' : '' ?>><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control etudiant-code">
                    <label for="code_etudiant">Choisir le code de l'étudiant<?= isset($e_code_etudiant) ? "(<span class='danger small'>$e_code_etudiant</span>)" : '' ?></label>
                    <select name="code_etudiant" id="code_etudiant">
                        <option value="-------------------">-------------------</option>
                        <?php foreach ($etudiants->getAll() as $etudiant) : ?>
                            <option value="<?= $etudiant->getId() ?>" <?= (isset($code_etudiant) && $code_etudiant == $etudiant->getId()) ? 'selected="selected"' : '' ?>><?= $etudiant->getCode() ?></option>

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