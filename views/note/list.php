<?php

use App\Dao\AnneeAcademiqueDao;
use App\Dao\CoursDao;
use App\Dao\EtudiantDao;

$firstTitle = 'Note';
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
            <a href="/note/new" class="btn btn-primary">Ajouter</a>
        </div>
        <hr>
        <table class="content-table" id="note">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cours</th>
                    <th>Etudiant</th>
                    <th>Session</th>
                    <th>Année A.</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['list_note'])) : ?>
                    <?php $i = 1;
                    foreach ($_SESSION['list_note']->getAll() as $note) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= CoursDao::getById((int)$note->getIdCours())->getCode() ?></td>
                            <td><?= EtudiantDao::getById((int)$note->getIdEtudiant())->getCode() ?></td>
                            <td><?= $note->getSession() ?></td>
                            <td><?= AnneeAcademiqueDao::getById((int)$note->getIdAnne())->getAnneeAcademique() ?></td>
                            <td><?= $note->getNote() ?></td>
                            <td class="last">
                                <form action="/note/edit" method="post">
                                    <input type="hidden" name="id" value="<?= $note->getId() ?? '' ?>">
                                    <button type="submit">Edit</button>
                                </form> &nbsp;|&nbsp;
                                <form class="delete" action="/note/delete" method="post">
                                    <input type="hidden" name="id" value="<?= $note->getId() ?? '' ?>">
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