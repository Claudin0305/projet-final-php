<?php

use App\Dao\AnneeAcademiqueDao;
use App\Dao\EtudiantDao;

$firstTitle = 'Etudiant';
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
            <a href="/etudiant/new" class="btn btn-primary">Ajouter</a>
        </div>
        <hr>
        <table class="content-table" id="etudiant">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Sexe</th>
                    <th>Etat</th>
                    <th>Année A.</th>
                    <th>Niveau</th>
                    <th>Date N.</th>
                    <th>Filière</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['list_etudiant'])) : ?>
                    <?php $i = 1;
                    foreach ($_SESSION['list_etudiant']->getAll() as $etudiant) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $etudiant->getCode() ?></td>
                            <td><?= $etudiant->getPrenom() ?></td>
                            <td><?= $etudiant->getNom() ?></td>
                            <td><?= $etudiant->getSexe() ?></td>
                            <td><?= $etudiant->getEtat() ?></td>
                            <td><?= AnneeAcademiqueDao::getById($etudiant->getIdAnneeAcademique())->getAnneeAcademique() ?></td>
                            <td><?= $etudiant->getNiveau() ?></td>
                            <td><?= $etudiant->getDateDeNaissance() ?></td>
                            <td><?= $etudiant->getFiliere() ?></td>
                            <td class="last">
                                <form action="/etudiant/edit" method="post">
                                    <input type="hidden" name="id" value="<?= $etudiant->getId() ?? '' ?>">
                                    <button type="submit">Edit</button>
                                </form> &nbsp;|&nbsp;
                                <form action="/etudiant/show" method="post">
                                    <input type="hidden" name="id" value="<?= $etudiant->getId() ?? '' ?>">
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