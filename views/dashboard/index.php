<?php
session_start();
if (!isset($_SESSION['user'])) {
    http_response_code(301);
    header('Location: /');
} else {
    $user = $_SESSION['user'];
}
use App\Dao\AnneeAcademiqueDao;
use App\Dao\CoursDao;
use App\Dao\EtudiantDao;
use App\Dao\NoteDao;
use App\Dao\ProfesseurDao;
use App\Dao\UtilisateurDao;

$title = 'Tableau de bord' ?>

<div class="cards">
    <div class="card-single">
        <div>
            <h2><?= AnneeAcademiqueDao::totalLine() ?></h2>
            <span>Annees</span>
        </div>
        <div>
            <span class="las la-users"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h2><?= ProfesseurDao::totalLine() ?></h2>
            <span>Professeur</span>
        </div>
        <div>
            <span class="las la-users"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h2><?= EtudiantDao::totalLine() ?></h2>
            <span>Etudiants</span>
        </div>
        <div>
            <span class="las la-users"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h2><?= CoursDao::totalLine() ?></h2>
            <span>Cours</span>
        </div>
        <div>
            <span class="las la-users"></span>
        </div>
    </div>

    <div class="card-single">
        <div>
            <h2><?= NoteDao::totalLine() ?></h2>
            <span>Note</span>
        </div>
        <div>
            <span class="fa fa-sticky-note"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h2><?= UtilisateurDao::totalLine() ?></h2>
            <span>Utilisateur</span>
        </div>
        <div>
            <span class="las la-users"></span>
        </div>
    </div>
    <div class="card-single">
        <div>
            <h2>54</h2>
            <span>Focus</span>
        </div>
        <div>
            <span class="las la-users"></span>
        </div>
    </div>
</div>