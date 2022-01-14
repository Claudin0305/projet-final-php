<?php

$firstTitle = 'Utilisateur';
session_start();
?>
<div class="flex-table">
    <div class="grid">
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <p><?= $_SESSION['success'] ?></p>
            </div>
        <?php endif ?>
        <div class="header-btn">
            <a href="/utilisateur/new" class="btn btn-primary">Ajouter</a>
        </div>
        <hr>
        <table class="content-table" id="utilisateur">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pseudo</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Etat</th>
                    <th>Poste</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['list_utilisateur'])) : ?>
                    <?php $i = 1;
                    foreach ($_SESSION['list_utilisateur']->getAll() as $utilisateur) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $utilisateur->getPseudo() ?></td>
                            <td><?= $utilisateur->getPrenom() ?></td>
                            <td><?= $utilisateur->getNom() ?></td>
                            <td><?= $utilisateur->getEtat() ?></td>
                            <td><?= $utilisateur->getPoste() ?></td>
                            <td class="last">
                                <form action="/utilisateur/edit" method="post">
                                    <input type="hidden" name="id" value="<?= $utilisateur->getId() ?? '' ?>">
                                    <button type="submit">Edit</button>
                                </form>&nbsp;|&nbsp;
                                <form action="/utilisateur/show" method="post">
                                    <input type="hidden" name="id" value="<?= $utilisateur->getId() ?? '' ?>">
                                    <button class="success" type="submit">Plus</button>
                                </form>
                            </td>
                        </tr>

                    <?php $i++;
                    endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>