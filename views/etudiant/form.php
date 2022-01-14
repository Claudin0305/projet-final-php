<?php
session_start();
if (isset($_SESSION['etudiant'])) {
    extract($_SESSION['etudiant']);
    // var_dump($_SESSION['etudiant']);
}
if (isset($_SESSION['etudiant_error'])) {
    extract($_SESSION['etudiant_error']);
    var_dump($_SESSION['etudiant_error']);
}
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
$etats = [
    "-------------------" => "-------------------",
    "Actif" => 'A',
    "Exclu" => 'E',
    "Terminé" => 'T',
    "Dossier fermé" => 'D'
];
$sexes = [
    "-------------------" => "-------------------",
    "Masculin" => 'M',
    "Féminin" => 'F'
];
$firstTitle = 'Etudiant';
$categorie = [

    "-------------------" => "-------------------",
    "Ancien" => 'Ancien',
    "Nouveau" => 'Nouveau'
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
?>
<div class="formulaire">
    <form action="<?= (isset($id) && !empty($id)) ? '/etudiant/update' : '/etudiant/insert' ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?? '' ?>">
        <div class="header">
            <h2>Etudiant</h2>
        </div>
        <div class="flex-form">
            <div class="grid grid-3">
                <div class="<?= (isset($id) && !empty($id)) ? 'form-control' : 'display-none' ?>">
                    <label for="annee_academique">Choisir l'année academique<?= isset($e_annee_academique) ? "(<span class='danger small'>$e_annee_academique</span>)" : '' ?></label>
                    <select name="annee_academique" id="annee_academique">
                        <option value="-------------------">-------------------</option>
                        <?php if (isset($_SESSION['list_annee'])) : ?>
                            <?php foreach ($_SESSION['list_annee']->getAll() as $value) : ?>
                                <option value="<?= $value->getId() ?>" <?= (isset($annee_academique) && $annee_academique === $value->getId()) ? 'selected="selected"' : '' ?>><?= $value->getAnneeAcademique() ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form-control <?= (isset($id) && !empty($id)) ? 'display-none' : '' ?>">
                    <label for="categorie">Choisir la catégorie<?= isset($e_categorie) ? "(<span class='danger small'>$e_categorie</span>)" : '' ?></label>
                    <select name="categorie" id="categorie">
                        <?php foreach ($categorie as $key => $value) : ?>
                            <option value="<?= $value ?>"><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="<?= (isset($id) && !empty($id)) ? 'form-control' : 'form-control display-none' ?>" id="code_div">
                    <label for="code">Code<?= isset($e_code) ? "(<span class='danger small'>$e_code</span>)" : '' ?></label>
                    <input type="text" name="code" id="code" value="<?= $code ?? '' ?>" placeholder="Saisir le code">
                </div>
                <div class="form-control">
                    <label for="prenom">Prénom<?= isset($e_prenom) ? "(<span class='danger small'>$e_prenom</span>)" : '' ?></label>
                    <input type="text" name="prenom" value="<?= $prenom ?? '' ?>" id="prenom" placeholder="Saisir le prénom">
                </div>
                <div class="form-control">
                    <label for="nom">Nom<?= isset($e_nom) ? "(<span class='danger small'>$e_nom</span>)" : '' ?></label>
                    <input type="text" name="nom" value="<?= $nom ?? '' ?>" id="nom" placeholder="Saisir le nom">
                </div>
                <div class="form-control">
                    <label for="adresse">Adresse<?= isset($e_adresse) ? "(<span class='danger small'>$e_adresse</span>)" : '' ?></label>
                    <input type="text" name="adresse" value="<?= $adresse ?? '' ?>" id="adresse" placeholder="Saisir l'adresse">
                </div>
                <div class="form-control">
                    <label for="telephone">Téléphone<?= isset($e_telephone) ? "(<span class='danger small'>$e_telephone</span>)" : '' ?></label>
                    <input type="text" name="telephone" value="<?= $telephone ?? '' ?>" id="telephone" placeholder="Saisir le téléphone">
                </div>
                <div class="form-control">
                    <label for="lieu_de_naissance">Lieu de naissance<?= isset($e_lieu) ? "(<span class='danger small'>$e_lieu</span>)" : '' ?></label>
                    <input type="text" name="lieu_de_naissance" value="<?= $lieu_de_naissance ?? '' ?>" id="lieu_de_naissance" placeholder="Saisir le lieu de naissance">
                </div>
                <div class="form-control">
                    <label for="date_de_naissance">Date naissance<?= isset($e_date_de_naissance) ? "(<span class='danger small'>$e_date_de_naissance</span>)" : '' ?></label>
                    <input type="date" value="<?= $date_de_naissance ?? '' ?>" name="date_de_naissance" id="date_de_naissance">
                </div>
                <div class="form-control">
                    <label for="sexe">Choisir le sexe<?= isset($e_sexe) ? "(<span class='danger small'>$e_sexe</span>)" : '' ?></label>
                    <select name="sexe" id="sexe">
                        <?php foreach ($sexes as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= (isset($sexe) && $sexe === $value) ? 'selected="selected"' : '' ?>><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="nif_or_cin">NIF/CIN<?= isset($e_nif_or_cin) ? "(<span class='danger small'>$e_nif_or_cin</span>)" : '' ?></label>
                    <input type="text" value="<?= $nif_or_cin ?? '' ?>" name="nif_or_cin" id="nif_or_cin" placeholder="Saisir le nif ou cin">
                </div>
                <div class="form-control">
                    <label for="mail">Email<?= isset($e_email) ? "(<span class='danger small'>$e_email</span>)" : '' ?></label>
                    <input type="email" value="<?= $mail ?? '' ?>" name="mail" id="mail" placeholder="mail@exemple.com">
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
                        <?php if (isset($id) && !empty($id) && isset($filiere) && !empty($filiere)) : ?>
                            <?php foreach ($nivFiliere[$filiere] as $niveauF) : ?>
                                <option value="<?= $niveauF ?>" <?= (isset($niveau) && $niveau === $niveauF) ? 'selected="selected"' : '' ?>><?= $niveauF ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="personne_de_reference">Personne de reference<?= isset($e_ref) ? "(<span class='danger small'>$e_ref</span>)" : '' ?></label>
                    <input type="text" value="<?=$personne_de_reference ?? '' ?>" name="personne_de_reference" id="personne_de_reference" placeholder="Saisir la personne de reference">
                </div>
                <div class="form-control">
                    <label for="tel_ref">Téléphone personne de réference<?= isset($e_tel_ref) ? "(<span class='danger small'>$e_tel_ref</span>)" : '' ?></label>
                    <input type="text" value="<?= $tel_ref ?? '' ?>" name="tel_ref" id="tel_ref" placeholder="Saisir le téléphone de la pers. de ref.">
                </div>
                <div class="form-control">
                    <label for="memo">Memo<?= isset($e_memo) ? "(<span class='danger small'>$e_memo</span>)" : '' ?></label>
                    <input type="text" value="<?= $memo ?? '' ?>" name="memo" id="memo" placeholder="Saisir le memo">
                </div>
                <div class="form-control <?= (isset($id) && !empty($id)) ? 'display-none' : '' ?>">
                    <input type="hidden" name="photo" value="<?= $photo ?? '' ?>">
                    <label for="photo">Photo<?= isset($e_photo) ? "(<span class='danger small'>$e_photo</span>)" : '' ?></label>
                    <input type="file" name="photo" id="photo">
                </div>
            </div>
        </div>
        <div class="btn-group">
            <input type="submit" value="Enregistrer" class="btn btn-primary">
        </div>
    </form>
</div>