<?php
session_start();
$firstTitle = 'Professeur';
$classes = [
    'firebrik',
    'green',
    'yellow',
    'red',
    'blue',
    'pink',
    'gray'
];
if (isset($_SESSION['onProfesseur'])) {
    $professeur = $_SESSION['onProfesseur'];
}
?>
<?php if (isset($professeur) && $professeur !== null) : ?>
    <div class="right"><button id="print">Imprimer</button></div>
    <div class="container-info" id="for-print">

        <div class="block-1">
            <?php if (!empty($professeur->getPhoto())) : ?>
                <img src="/pictures/<?= $professeur->getPhoto() ?>" alt="profil">
            <?php else : ?>
                <div class="photo <?= $classes[rand(0, count($classes) - 1)] ?>"><?= strtoupper(substr($professeur->getPrenom(), 0, 1)) . strtoupper(substr($professeur->getNom(), 0, 1)) ?></div>
            <?php endif ?>
            <h4><?= $professeur->getPrenom() . " " . $professeur->getNom() ?></h4>
            <div class="grid grid-2"></div>
            <p><b>Sexe:&nbsp;&nbsp;&nbsp;&nbsp;</b> <?= $professeur->getSexe() ?></p>
            <p><b>Code:&nbsp;</b> <?= $professeur->getCode() ?></p>
        </div>
        <div class="block-2">
            <div class="grid grid-2">
                <p><b>Filiere</b></p>
                <p><?= $professeur->getFiliere() ?></p>
                <p><b>Niveau</b></p>
                <p><?= $professeur->getNiveau() ?></p>
                <p><b>Adresse</b></p>
                <p><?= $professeur->getAdresse() ?></p>
                <p><b>Date de naissance</b></p>
                <p><?= $professeur->getDateDeNaissance() ?></p>
                <p><b>Lieu de naissance</b></p>
                <p><?= $professeur->getLieuDeNaissance() ?></p>
                <p><b>Téléphone</b></p>
                <p><?= $professeur->getTelephone() ?></p>
                <p><b>Poste</b></p>
                <p><?= $professeur->getPoste() ?></p>
            </div>
        </div>
        <div class="block-3">
            <div class="grid grid-2">
                <p><b>NIF/CIN</b></p>
                <p><?= $professeur->getNifOrCin() ?></p>
                <p><b>Etat</b></p>
                <p><?= $professeur->getEtat() ?></p>
                <p><b>Salaire</b></p>
                <p><?= $professeur->getSalaire() ?></p>
                <p><b>Email</b></p>
                <p><?= $professeur->getEmail() ?></p>
                <p><b>Statut</b></p>
                <p><?= $professeur->getStatut() ?></p>
                <p><b>Cours à ens.</b></p>
                <p><?= $professeur->getCoursAEnseigner() ?></p>
                <p><b>Memo</b></p>
                <p><?= $professeur->getMemo() ?></p>
            </div>
        </div>
    </div>
    <div class="delete">
        <form class="delete" action="/professeur/delete" method="post">
            <input type="hidden" name="id" value="<?= $professeur->getId() ?? '' ?>">
            <button class="btn-danger"  id="del" type="submit">Delete</button>
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