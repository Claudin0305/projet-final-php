<?php
session_start();
if (isset($_SESSION['professeur'])) {
    extract($_SESSION['professeur']);
    if (isset($_SESSION['professeur']['filiere'])) {
        $fil = $_SESSION['professeur']['filiere'];
    }
}
if (isset($_SESSION['professeur_error'])) {
    extract($_SESSION['professeur_error']);
    var_dump($_SESSION['professeur_error']);
}
$etats = [
    "-------------------" => "-------------------",
    "Actif" => 'A',
    "Exclu" => 'E',
    "Mise en disponibilité" => 'M',
    "Conge étude" => 'C'
];
$statuts = [
    "-------------------" => "-------------------",
    "Celibataire" => 'Celibataire',
    "Marié" => 'Marié',
    "Divorcé" => 'Divorcé'
];
$sexes = [
    "-------------------" => "-------------------",
    "Masculin" => 'M',
    "Féminin" => 'F'
];
$firstTitle = 'Professeur';
$categorie = [

    "-------------------" => "-------------------",
    "Ancien" => 'Ancien',
    "Nouveau" => 'Nouveau'
];
$niveaux = [

    "-------------------" => "-------------------",
    "Master 1" => 'M1',
    "Master 2" => 'M2',
    "Doctorat" => "Doctorat"
];
$filieres = [
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
    <form action="<?= (isset($id) && !empty($id)) ? '/professeur/update' : '/professeur/insert' ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?? '' ?>">
        <div class="header">
            <h2>Professeur</h2>
        </div>
        <div class="flex-form">
            <div class="grid grid-3">
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
                    <label for="statut">Choisir le statut<?= isset($e_statut) ? "(<span class='danger small'>$e_statut</span>)" : '' ?></label>
                    <select name="statut" id="statut">
                        <?php foreach ($statuts as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= (isset($statut) && $statut === $value) ? 'selected="selected"' : '' ?>><?= $key ?></option>
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
                    <label for="filiere">Choisir filière <?= isset($e_filiere) ? "(<span class='danger small'>$e_filiere</span>)" : '' ?></label>
                    <select name="filiere[]" multiple size="2" id="filiere_prof">
                        <?php foreach ($filieres as $value) : ?>
                            <?php if (isset($fil) && $fil !== null) : ?>
                                <?php foreach (explode(" ", $fil) as $f) : ?>
                                    <option value="<?= $value ?>" <?= $f === $value ? 'selected="selected"' : '' ?>><?= $value ?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                            <?php if (!isset($fil) || $fil === null) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="niveau_prof">Choisir le niveau<?= isset($e_niveau) ? "(<span class='danger small'>$e_niveau</span>)" : '' ?></label>
                    <select name="niveau" id="niveau_prof">
                        <?php foreach ($niveaux as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= (isset($niveau) && $niveau === $value) ? 'selected="selected"' : '' ?>><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="salaire">Salaire<?= isset($e_salaire) ? "(<span class='danger small'>$e_salaire</span>)" : '' ?></label>
                    <input type="number" value="<?= $salaire ?? '' ?>" name="salaire" id="salaire" placeholder="Saisir le salaire">
                </div>
                <div class="form-control">
                    <label for="cours">Cours à enseigner<?= isset($e_cours) ? "(<span class='danger small'>$e_cours</span>)" : '' ?></label>
                    <input type="text" value="<?= $cours ?? '' ?>" name="cours" id="cours" placeholder="Saisir le(s) cours">
                </div>
                <div class="form-control">
                    <label for="poste">Poste<?= isset($e_poste) ? "(<span class='danger small'>$e_poste</span>)" : '' ?></label>
                    <input type="text" value="<?= $poste ?? '' ?>" name="poste" id="poste" placeholder="Saisir le poste">
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