<?php

use App\Dao\AnneeAcademiqueDao;

$firstTitle = 'Année Academique';
session_start();


?>
<div class="flex-table">
    <div class="grid">
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <p><?= $_SESSION['success'] ?></p>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['e_echec'])) : ?>
            <div class="echec">
                <p><?= $_SESSION['e_echec'] ?></p>
            </div>
        <?php endif ?>
        <div class="flex-head">
            <div class="header-btn">
                <a href="/annee/new" class="btn btn-primary">Ajouter</a>
            </div>
            <div class="header-btn">
                <a href="/annee/passassion" class="btn btn-print">Lancer passassion</a>
            </div>
        </div>
        <hr>
        <table class="content-table" id="annee">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Année debut</th>
                    <th>Année fin</th>
                    <th>Date debut</th>
                    <th>Date fin</th>
                    <th>Etat</th>
                    <th>Année academique</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['list_annee'])) : ?>
                    <?php $i = 1;
                    foreach ($_SESSION['list_annee']->getAll() as $annee) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $annee->getAnneeDebut() ?></td>
                            <td><?= $annee->getAnneeFin() ?></td>
                            <td><?= $annee->getDateDebut() ?></td>
                            <td><?= $annee->getDateFin() ?></td>
                            <td><?= $annee->getEtat() ?></td>
                            <td><?= $annee->getAnneeAcademique() ?></td>
                            <td class="last">
                                <form action="/annee/edit" method="post">
                                    <input type="hidden" name="id" value="<?= $annee->getId() ?? '' ?>">
                                    <button type="submit">Edit</button>
                                </form> &nbsp;|&nbsp;
                                <form class="delete" action="/annee/delete" method="post">
                                    <input type="hidden" name="id" value="<?= $annee->getId() ?? '' ?>">
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