<?php
session_start();
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}
$firstTitle = 'Utilisateur';
$classes = [
    'firebrik',
    'green',
    'yellow',
    'red',
    'blue',
    'pink',
    'gray'
];
if (isset($_SESSION['onUtilisateur'])) {
    $utilisateur = $_SESSION['onUtilisateur'];
}
?>
<?php if (isset($utilisateur) && $utilisateur !== null) : ?>
    <div class="container-info">

        <div class="block-1">
            <?php if (!empty($utilisateur->getPhoto())) : ?>
                <img src="/pictures/<?= $utilisateur->getPhoto() ?>" alt="profil">
            <?php else : ?>
                <div class="photo <?= $classes[rand(0, count($classes) - 1)] ?>"><?= strtoupper(substr($utilisateur->getPrenom(), 0, 1)) . strtoupper(substr($utilisateur->getNom(), 0, 1)) ?></div>
            <?php endif ?>
            <h4><?= $utilisateur->getPrenom() . " " . $utilisateur->getNom() ?></h4>
            <div class="grid grid-2"></div>
        </div>
        <div class="block-2">
            <div class="grid grid-2">
                <p><b>Pseudo</b></p>
                <p><?= $utilisateur->getPseudo() ?></p>
                <p><b>Poste</b></p>
                <p><?= $utilisateur->getPoste() ?></p>
                <p><b>Etat</b></p>
                <p><?= $utilisateur->getEtat() ?></p>
                <p><b>Modules</b></p>
                <p><?= $utilisateur->getModules() ?></p>
            </div>
        </div>
    </div>
    <div class="delete">
        <?php if(isset($user) && $user->getId() != $utilisateur->getId() && $utilisateur->getPseudo() != 'root' && $utilisateur->getPseudo() !='admin'):?>
        <form class="delete" action="/utilisateur/delete" method="post">
            <input type="hidden" name="id" value="<?= $utilisateur->getId() ?? '' ?>">
            <button class="btn-danger" id="del" type="submit">Delete</button>
        </form>
        <?php endif?>
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