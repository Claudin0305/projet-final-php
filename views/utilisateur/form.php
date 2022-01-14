<?php
session_start();
if (isset($_SESSION['utilisateur'])) {
    extract($_SESSION['utilisateur']);
    // var_dump($_SESSION['etudiant']);
}
if (isset($_SESSION['utilisateur_error'])) {
    extract($_SESSION['utilisateur_error']);
    var_dump($_SESSION['utilisateur_error']);
}

$etats = [
    "-------------------" => "-------------------",
    "Actif" => 'Actif',
    "Inactif" => 'Inactif',
];
$firstTitle = 'Utilisateur';
$modules = [
    "Année Academique" => "annee",
    "Professeur" => "professeur",
    "Etudiant" => 'etudiant',
    "Cours" => "cours",
    "Note" => 'note',
    "Palmarès" => 'palmares',
    "Utilisateur" => 'utilisateur'
];

?>
<div class="formulaire">
    <form action="<?= (isset($id) && !empty($id)) ? '/utilisateur/update' : '/utilisateur/insert' ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?? '' ?>">
        <div class="header">
            <h2>Utilisateur</h2>
        </div>
        <div class="flex-form">
            <div class="grid grid-2">
                <div class="form-control">
                    <label for="prenom">Prénom<?= isset($e_prenom) ? "(<span class='danger small'>$e_prenom</span>)" : '' ?></label>
                    <input type="text" name="prenom" value="<?= $prenom ?? '' ?>" id="prenom" placeholder="Saisir le prénom">
                </div>
                <div class="form-control">
                    <label for="nom">Nom<?= isset($e_nom) ? "(<span class='danger small'>$e_nom</span>)" : '' ?></label>
                    <input type="text" name="nom" value="<?= $nom ?? '' ?>" id="nom" placeholder="Saisir le nom">
                </div>
                <div class="form-control">
                    <label for="poste">Poste<?= isset($e_poste) ? "(<span class='danger small'>$e_poste</span>)" : '' ?></label>
                    <input type="text" name="poste" value="<?= $poste ?? '' ?>" id="poste" placeholder="Saisir le poste">
                </div>
                <div class="form-control">
                    <label for="pseudo">Pseudo<?= isset($e_pseudo) ? "(<span class='danger small'>$e_pseudo</span>)" : '' ?></label>
                    <input type="text" name="pseudo" value="<?= $pseudo ?? '' ?>" id="pseudo" placeholder="Saisir le pseudo">
                </div>
                <div class="form-control">
                    <label for="etat">choisir l'état<?= isset($e_etat) ? "(<span class='danger small'>$e_etat</span>)" : '' ?></label>
                    <select name="etat" id="etat">
                        <?php foreach ($etats as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= (isset($etat) && $etat === $value) ? 'selected="selected"' : '' ?>><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control <?= (isset($id) && !empty($id)) ? 'display-none' : '' ?>">
                    <input type="hidden" name="photo" value="<?= $photo ?? '' ?>">
                    <label for="photo">Photo<?= isset($e_photo) ? "(<span class='danger small'>$e_photo</span>)" : '' ?></label>
                    <input type="file" name="photo" id="photo">
                </div>
                <?php if (!isset($id) && empty($id)) : ?>
                    <div class="form-control">
                        <label for="pas">Mot de pass<?= isset($e_pas) ? "(<span class='danger small'>$e_pas</span>)" : '' ?></label>
                        <input type="password" name="pas" id="pas" placeholder="Saisir le mot de passe">
                    </div>
                    <div class="form-control">
                        <label for="r_pas">Confirmé mot de pass<?= isset($e_c_pas) ? "(<span class='danger small'>$e_c_pas</span>)" : '' ?></label>
                        <input type="password" name="r_pas" id="r_pas" placeholder="Confirmé le mot de passe">
                    </div>
                <?php else : ?>
                    <input type="hidden" name="pas" value="<?= $pas ?? '' ?>">
                <?php endif ?>
            </div>
        </div>
        <div class="mod">
            <h3>Modules d'accès</h3>
            <?php foreach ($modules as $key => $value) : ?>
                <input <?= (isset($module) && in_array($value, $module)) ? 'checked="checked"' : '' ?> class="module" type="checkbox" name="module[]" id="<?= $value ?>" value="<?= $value ?>"> <label for="<?= $value ?>"><?= $key ?></label>
                <br>
            <?php endforeach ?>
        </div>
        <div class="btn-group">
            <input type="submit" value="Enregistrer" class="btn btn-primary">
        </div>
    </form>
</div>