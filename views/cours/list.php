<?php

use App\Dao\AnneeAcademiqueDao;

$firstTitle = 'Cours';
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
            <a href="/cours/new" class="btn btn-primary">Ajouter</a>
        </div>
        <hr>
        <table class="content-table" id="cours">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Code</th>
                    <th>Coef.</th>
                    <th>Filiere</th>
                    <th>Niveau</th>
                    <th>Session</th>
                    <th>Etat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['list_cours'])) : ?>
                    <?php $i = 1;
                    foreach ($_SESSION['list_cours']->getAll() as $cours) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $cours->getNom() ?></td>
                            <td><?= $cours->getCode() ?></td>
                            <td><?= $cours->getCoefficient() ?></td>
                            <td><?= $cours->getFiliere() ?></td>
                            <td><?= $cours->getNiveau() ?></td>
                            <td><?= $cours->getSession() ?></td>
                            <td><?= $cours->getEtat() ?></td>
                            <td class="last">
                                <form action="/cours/edit" method="post">
                                    <input type="hidden" name="id" value="<?= $cours->getId() ?? '' ?>">
                                    <button type="submit">Edit</button>
                                </form> &nbsp;|&nbsp;
                                <form class="delete" action="/cours/delete" method="post">
                                    <input type="hidden" name="id" value="<?= $cours->getId() ?? '' ?>">
                                    <button class="danger" id="del" type="submit">Delete</button>
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
                            </td>
                        </tr>

                    <?php $i++;
                    endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>