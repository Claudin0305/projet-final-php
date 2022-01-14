<?php
session_start();
$firstTitle = 'Etudiant';
$classes = [
    'firebrik',
    'green',
    'yellow',
    'red',
    'blue',
    'pink',
    'gray'
];
if (isset($_SESSION['onEtudiant'])) {
    $etudiant = $_SESSION['onEtudiant'];
}
?>
<?php if (isset($etudiant) && $etudiant !== null) : ?>
    <div class="right"><button id="print">Imprimer</button></div>
    <div class="container-info" id="for-print">

        <div class="block-1">
            <?php if (!empty($etudiant->getPhoto())) : ?>
                <img src="/pictures/<?= $etudiant->getPhoto() ?>" alt="profil">
            <?php else : ?>
                <div class="photo <?= $classes[rand(0, count($classes) - 1)] ?>"><?= strtoupper(substr($etudiant->getPrenom(), 0, 1)) . strtoupper(substr($etudiant->getNom(), 0, 1)) ?></div>
            <?php endif ?>
            <h4><?= $etudiant->getPrenom() . " " . $etudiant->getNom() ?></h4>
            <div class="grid grid-2"></div>
            <p><b>Sexe:&nbsp;&nbsp;&nbsp;&nbsp;</b> <?= $etudiant->getSexe() ?></p>
            <p><b>Code:&nbsp;</b> <?= $etudiant->getCode() ?></p>
        </div>
        <div class="block-2">
            <div class="grid grid-2">
                <p><b>Filiere</b></p>
                <p><?= $etudiant->getFiliere() ?></p>
                <p><b>Niveau</b></p>
                <p><?= $etudiant->getNiveau() ?></p>
                <p><b>Adresse</b></p>
                <p><?= $etudiant->getAdresse() ?></p>
                <p><b>Date de naissance</b></p>
                <p><?= $etudiant->getDateDeNaissance() ?></p>
                <p><b>Lieu de naissance</b></p>
                <p><?= $etudiant->getLieuDeNaissance() ?></p>
                <p><b>Téléphone</b></p>
                <p><?= $etudiant->getTelephone() ?></p>
            </div>
        </div>
        <div class="block-3">
            <div class="grid grid-2">
                <p><b>NIF/CIN</b></p>
                <p><?= $etudiant->getNifOrCin() ?></p>
                <p><b>Etat</b></p>
                <p><?= $etudiant->getEtat() ?></p>
                <p><b>Année Academique</b></p>
                <p><?= $etudiant->getAnneeAcademique() ?></p>
                <p><b>Email</b></p>
                <p><?= $etudiant->getEmail() ?></p>
                <p><b>Personne de réf.</b></p>
                <p><?= $etudiant->getPersonneDeReference() ?></p>
                <p><b>Tél. Pers. de réf.</b></p>
                <p><?= $etudiant->getTelPersonneDeRef() ?></p>
                <p><b>Memo</b></p>
                <p><?= $etudiant->getMemo() ?></p>
            </div>
        </div>
    </div>
    <div class="delete">
        <form class="delete" action="/etudiant/delete" method="post">
            <input type="hidden" name="id" value="<?= $etudiant->getId() ?? '' ?>">
            <button class="btn-danger" id="del" type="submit">Delete</button>
        </form>
        <div class="cover">
            <div class="modale-glob">
                <div class="content-modale" id="confirmation">
                    <div class="modale">
                        <section>
                            <div class="modale-header">
                                <h2>Voulez vous vraiment supprimer?</h2>
                            </div>
                            <section class="modale-content">
                                <p>Vous ne pouvez plus revenir en arrière</p>
                            </section>
                            <footer class="modale-footer">
                                <button id="cancel">Annuler</button>
                                <button id="conf">Confirmer</button>
                            </footer>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>