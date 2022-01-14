<?php

use App\Dao\ProfesseurDao;

session_start();
if (isset($_SESSION['cours'])) {
    extract($_SESSION['cours']);
}
if (isset($_SESSION['cours_error'])) {
    extract($_SESSION['cours_error']);
    var_dump($_SESSION['cours_error']);
}

if (isset($_SESSION['onCours'])) {
    extract($_SESSION['onCours']);
}
if(isset($_SESSION['horaire'])){
    extract($_SESSION['horaire']);
}

$niveauM = ["-------------------", "EUF", "L1", "L2", "L3", "L4", "L5", "L6"];
$niveauG = ["-------------------", "EUF", "L1", "L2", "L3", "L4"];
$niv = ["-------------------", "EUF", "L1", "L2", "L3"];
$nivFiliere = [
    "-------------------" => "-------------------",
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
$profs = new ProfesseurDao();
$etats = [
    "-------------------" => "-------------------",
    "Entrain de dispenser" => 'E',
    "Déjà dispenser" => 'D',
    "Non dispenser" => 'N'
];

$days = [
    'Lundi',
    'Mardi',
    'Mercredi',
    'Jeudi',
    'Vendredi'
];
$sessions = [
    "-------------------" => "-------------------",
    "Session 1" => 'S1',
    "Session 2" => 'S2'
];
$firstTitle = 'Cours';

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
?>
<div class="formulaire">
    <form action=" <?= (isset($id) && !empty($id)) ? '/cours/update' : '/cours/insert' ?>" method="post">
        <input type="hidden" name="id" value="<?= $id ?? '' ?>">
        <div class="header">
            <h2>Cours</h2>
        </div>
        <div class="flex-form">
            <div class="grid grid-3">
                <div class="<?= (isset($id) && !empty($id)) ? 'form-control' : 'form-control display-none' ?>">
                    <label for="code">Code<?= isset($e_code) ? "(<span class='danger small'>$e_code</span>)" : '' ?></label>
                    <input type="text" value="<?=$code ??''?>" name="code" id="code" placeholder="Saisir le code du cours">
                </div>
                <div class="form-control">
                    <label for="nom">Nom<?= isset($e_nom) ? "(<span class='danger small'>$e_nom</span>)" : '' ?></label>
                    <input type="text" name="nom" value="<?=$nom ?? ''?>" id="nom" placeholder="Saisir le nom du cours">
                </div>
                <div class="form-control">
                    <label for="filiere">Choisir la filiere<?= isset($e_filiere) ? "(<span class='danger small'>$e_filiere</span>)" : '' ?></label>
                    <select name="filiere" id="filiere">
                        <?php foreach ($filieres as $value) : ?>
                            <option value="<?= $value ?>" <?= (isset($filiere) && $filiere === $value) ? 'selected="selected"' : '' ?>><?= $value ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="niveau">Choisir le niveau<?= isset($e_niveau) ? "(<span class='danger small'>$e_niveau</span>)" : '' ?></label>
                    <select name="niveau" id="niveau">
                        <?php if (isset($filiere) && !empty($filiere)) : ?>
                            <?php foreach ($nivFiliere[$filiere] as $niveauF) : ?>
                                <option value="<?= $niveauF ?>" <?= (isset($niveau) && $niveau === $niveauF) ? 'selected="selected"' : '' ?>><?= $niveauF ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="etat">choisir la session<?= isset($e_session) ? "(<span class='danger small'>$e_session</span>)" : '' ?></label>
                    <select name="session" id="session">
                        <?php foreach ($sessions as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= (isset($session) && $session === $value) ? 'selected="selected"' : '' ?>><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="coefficient">choisir le coefficient<?= isset($e_coefficient) ? "(<span class='danger small'>$e_coefficient</span>)" : '' ?></label>
                    <select name="coefficient" id="coefficient">
                        <option value="-------------------">-------------------</option>
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <option value="<?= $i ?>" <?= (isset($coefficient) && $coefficient == $i) ? 'selected="selected"' : '' ?>><?= $i ?></option>
                        <?php endfor ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="etat">choisir l'état<?= isset($e_etat) ? "(<span class='danger small'>$e_etat</span>)" : '' ?></label>
                    <select name="etat" id="etat">
                        <?php foreach ($etats as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= (isset($etat) && $etat === $value) ? 'selected="selected"' : '' ?>><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="prof_titulaire">choisir le professeur titulaire<?= isset($e_prof_titulaire) ? "(<span class='danger small'>$e_prof_titulaire</span>)" : '' ?></label>
                    <select name="prof_titulaire" id="prof_titulaire">
                        <option value="-------------------">-------------------</option>
                        <?php foreach ($profs->getAll() as $p) : ?>
                            <option value="<?= $p->getId() ?>" <?= (isset($prof_titulaire) && $prof_titulaire == $p->getId()) ? 'selected="selected"' : '' ?>><?= $p->getPrenom() . " " . $p->getNom() ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="prof_suppleant">choisir le professeur suppléant<?= isset($e_prof_suppleant) ? "(<span class='danger small'>$e_prof_suppleant</span>)" : '' ?></label>
                    <select name="prof_suppleant" id="prof_suppleant">
                        <option value="-------------------">-------------------</option>
                        <option value="Aucun" <?= (isset($prof_suppleant) && $prof_suppleant == 'Aucun') ? 'selected="selected"' : '' ?>>Aucun</option>
                        <?php foreach ($profs->getAll() as $p) : ?>
                            <option value="<?= $p->getId() ?>" <?= (isset($prof_suppleant) && $prof_suppleant == $p->getId()) ? 'selected="selected"' : '' ?>><?= $p->getPrenom() . " " . $p->getNom() ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="horaire grid grid-2 grid-c">
            <div class="day">
                <?php foreach ($days as $d) : ?>
                    <?php if (isset($jours)) : ?>
                        <?php foreach ($jours as $j) : ?>
                            <input type="checkbox" name="jours[]" <?= $j == $d ? "checked='checked'":""?> id="<?= $d ?>" class="jours" value="<?= $d ?>"> <label for="<?= $d ?>"><?= $d ?></label>
                            <br>
                        <?php endforeach ?>
                    <?php else : ?>
                        <input type="checkbox" name="jours[]" id="<?= $d ?>" class="jours" value="<?= $d ?>"> <label for="<?= $d ?>"><?= $d ?></label>
                        <br>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
            <div class="times grid grid-2">
                <?php foreach ($days as $d) : ?>
                    <div class="form-control <?= isset(${"debut_$d"}) && ${"debut_$d"} != null ? '' : 'display-none' ?> <?= $d ?>">
                        <label for="debut_<?= $d ?>">Heure debut <?= $d ?></label>
                        <input value="<?= ${"debut_$d"} ?? '' ?>" type="text" name="debut_<?= $d ?>" id="debut_<?= $d ?>">
                    </div>
                    <div class="form-control <?= isset(${"fin_$d"}) && ${"fin_$d"} != null ? '' : 'display-none' ?>  <?= $d ?>">
                        <label for="fin_<?= $d ?>">Heure fin <?= $d ?></label>
                        <input value="<?= ${"fin_$d"} ?? '' ?>" type="text" name="fin_<?= $d ?>" id="fin_<?= $d ?>">
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <br>
        <div class="btn-group">
            <input type="submit" value="Enregistrer" class="btn btn-primary">
        </div>
    </form>
</div>