<?php


$firstTitle = 'Professeur';
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
            <a href="/professeur/new" class="btn btn-primary">Ajouter</a>
        </div>
        <hr>
        <table class="content-table" id="professeur">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Sexe</th>
                    <th>Etat</th>
                    <th>Niveau</th>
                    <th>Date N.</th>
                    <th>Filière</th>
                    <th>Nif/Cin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['list_professeur'])) : ?>
                    <?php $i = 1;
                    foreach ($_SESSION['list_professeur']->getAll() as $professeur) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $professeur->getPrenom() ?></td>
                            <td><?= $professeur->getNom() ?></td>
                            <td><?= $professeur->getSexe() ?></td>
                            <td><?= $professeur->getEtat() ?></td>
                            <td><?= $professeur->getNiveau() ?></td>
                            <td><?= $professeur->getDateDeNaissance() ?></td>
                            <td><?= $professeur->getFiliere() ?></td>
                            <td><?= $professeur->getNifOrCin() ?></td>
                            <td class="last">
                                <form action="/professeur/edit" method="post">
                                    <input type="hidden" name="id" value="<?= $professeur->getId() ?? '' ?>">
                                    <button type="submit">Edit</button>
                                </form> &nbsp;|&nbsp;
                                <form action="/professeur/show" method="post">
                                    <input type="hidden" name="id" value="<?= $professeur->getId() ?? '' ?>">
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