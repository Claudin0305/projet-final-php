<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $modules = explode(',', $user->getModules());
    $t = explode('/', $_SERVER['REQUEST_URI']);
    if (!in_array($t[1], $modules) && $t[1] != 'dashboard' && $t[1] != 'error') {
        http_response_code(301);
        header('Location: /dashboard');
        die;
    }
} else {
    http_response_code(301);
    header('Location: /');
    die;
}
$classes = [
    'firebrik',
    'green',
    'yellow',
    'red',
    'blue',
    'pink',
    'gray'
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.1.1/b-html5-2.1.1/b-print-2.1.1/datatables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.1.1/b-html5-2.1.1/b-print-2.1.1/datatables.min.js"></script>

</head>

<body>
    <input type="checkbox" name="" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"></span><span>School M.</span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="/dashboard"><span class="fa fa-home"></span><span>Tableau de bord</span></a>
                </li>
                <li class="<?= isset($modules) && in_array('annee', $modules) ? '' : 'display-none' ?>">
                    <a href="/annee"><span class="fa fa-calendar-plus"></span></span><span>Annee Academique</span></a>
                </li>
                <li class="<?= isset($modules) && in_array('professeur', $modules) ? '' : 'display-none' ?>">
                    <a href="/professeur"><span class="fas fa-chalkboard-teacher"></span><span>Professeur</span></a>
                </li>
                <li class="<?= isset($modules) && in_array('etudiant', $modules) ? '' : 'display-none' ?>">
                    <a href="/etudiant"><span class="fa fa-user-graduate"></span><span>Etudiant</span></a>
                </li>
                <li class="<?= isset($modules) && in_array('cours', $modules) ? '' : 'display-none' ?>">
                    <a href="/cours"><span class="fab fa-leanpub"></span></span><span>Cours</span></a>
                </li>
                <li class="<?= isset($modules) && in_array('note', $modules) ? '' : 'display-none' ?>">
                    <a href="/note"><span class="fa fa-sticky-note"></span></span><span>Note</span></a>
                </li>
                <li class="<?= isset($modules) && in_array('palmares', $modules) ? '' : 'display-none' ?>">
                    <a href="/palmares"><span class="fa fa-discourse"></span></span><span>Palmares</span></a>
                </li>
                <li class="<?= isset($modules) && in_array('utilisateur', $modules) ? '' : 'display-none' ?>">
                    <a href="/utilisateur"><span class="fa fa-user"></span><span>Utilisateur</span></a>
                </li>
                <li>
                    <a href="/user/logout"><span class="fas fa-sign-out-alt"></span><span>Deconnexion</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="pointer las la-bars"></span>
                </label>
                <?= $firstTitle ?? 'Tableau de bord' ?>
            </h2>
            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="rechercher ici">
            </div>
            <div class="user-wrapper">
                <?php if (isset($user) && !empty($user->getPhoto())) : ?>
                    <img class="image-profil" src="/pictures/<?= $user->getPhoto() ?>" alt="">
                <?php endif ?>
                <?php if (isset($user) && empty($user->getPhoto())) : ?>
                    <div class="image-profil flex-img <?= $classes[rand(0, count($classes) - 1)] ?>"><?= strtoupper(substr($user->getPrenom(), 0, 1)) . strtoupper(substr($user->getNom(), 0, 1)) ?></div>
                <?php endif ?>
                <div>
                    <h4><?= isset($user) ? $user->getPrenom() . " " . $user->getNom() : '' ?></h4>
                    <small><?= isset($user) ? $user->getPseudo() : '' ?></small>
                </div>
            </div>
        </header>
        <main>
            <?= $content ?>
        </main>
    </div>
    <script src="/assets/js/app.js"></script>

</body>

</html>