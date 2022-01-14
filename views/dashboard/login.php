<?php
session_start();
if (!isset($_SESSION['user']) && $_SERVER['REQUEST_URI'] != '/') {
    http_response_code(301);
    header('Location: /');
    die;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body class="flex-login">
    <div class="connexion-form">
        <div class="header-login">
            <h1>Connectez vous</h1>
        </div>
        <form class="style-log" action="/utilisateur/login" method="post">
            <?php if (isset($_SESSION['e_login'])) : ?>
                <?php foreach ($_SESSION['e_login'] as $err) : ?>
                    <p class="danger"><?= $err ?></p>
                <?php endforeach ?>
            <?php endif ?>
            <div class="form-control">
                <label for="pseudo">Pseudo</label>
                <input class="max" type="text" name="pseudo" id="pseudo" placeholder="saisir le nom d'utilisateur">
            </div>
            <div class="form-control">
                <label for="password">Mot de pass</label>
                <input class="max" type="password" name="password" id="password" placeholder="saisir le mot de passe">
            </div>
            <div class="grid grid-2">
                <div class="detache">
                    <input type="checkbox" name="souvient" id="souvient"><label for="souvient"> Se souvient de moi</label>
                </div>
                <div class="detache">
                    <p><a href="">Mot de passe oublier?</a></p>
                </div>
            </div>
            <div class="form-control">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </form>
    </div>
    </div>
</body>

</html>