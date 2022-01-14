<?php
require '../vendor/autoload.php';
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
define('PATH_TO_CONTROLLER', dirname(__DIR__) . '/Controller');
define('PATH_TO_VIEW', dirname(__DIR__) . '/views');
$router = new App\Router(PATH_TO_VIEW, PATH_TO_CONTROLLER);
$router
    ->get('GET', '/dashboard', 'dashboard/index', 'homepage')
    ->get('GET' ,'/', 'dashboard/login', 'connexion')

    //Annee
    ->get('GET', '/annee', 'AnneeController#index', 'annee')
    ->get('POST', '/annee/insert', 'AnneeController#insert', 'annee_insert')
    ->get('GET', '/annee/passassion', 'AnneeController#makePassassion', 'annee_passasion')
    ->get('POST', '/annee/delete', 'AnneeController#delete', 'annee_delete')
    ->get('GET', '/annee/new', 'annee/form', 'annee_form')
    ->get('GET', '/annee/list', 'annee/list', 'annee_list')
    ->get('POST', '/annee/edit', 'AnneeController#edit', 'annee_edit')
    ->get('POST', '/annee/update', 'AnneeController#update', 'annee_update')


    //Etudiant
    ->get('GET', '/etudiant', 'EtudiantController#index', 'etudiant')
    ->get('POST', '/etudiant/show', 'EtudiantController#show', 'etudiant_show')
    ->get('POST', '/etudiant/delete', 'EtudiantController#delete', 'etudiant_delete')
    ->get('GET', '/etudiant/show-data', 'etudiant/show', 'etudiant_show_data')
    ->get('POST', '/etudiant/insert', 'EtudiantController#insert', 'etudiant_insert')
    ->get('GET', '/etudiant/new', 'etudiant/form', 'etudiant_form')
    ->get('GET', '/etudiant/list', 'etudiant/list', 'etudiant_list')
    ->get('POST', '/etudiant/edit', 'EtudiantController#edit', 'etudiant_edit')
    ->get('POST', '/etudiant/update', 'EtudiantController#update', 'etudiant_update')

    //Professeur

    ->get('GET', '/professeur', 'ProfesseurController#index', 'professeur')
    ->get('POST', '/professeur/show', 'ProfesseurController#show', 'professeur_show')
    ->get('POST', '/professeur/delete', 'ProfesseurController#delete', 'professeur_delete')
    ->get('GET', '/professeur/show-data', 'professeur/show', 'professeur_show_data')
    ->get('POST', '/professeur/insert', 'ProfesseurController#insert', 'professeur_insert')
    ->get('GET', '/professeur/new', 'professeur/form', 'professeur_form')
    ->get('GET', '/professeur/list', 'professeur/list', 'professeur_list')
    ->get('POST', '/professeur/edit', 'ProfesseurController#edit', 'professeur_edit')
    ->get('POST', '/professeur/update', 'ProfesseurController#update', 'professeur_update')

    //Cours

    ->get('GET', '/cours', 'CoursController#index', 'cours')
    ->get('POST', '/cours/insert', 'CoursController#insert', 'cours_insert')
    ->get('POST', '/cours/delete', 'CoursController#delete', 'cours_delete')
    ->get('GET', '/cours/new', 'cours/form', 'cours_form')
    ->get('GET', '/cours/list', 'cours/list', 'cours_list')
    ->get('POST', '/cours/edit', 'CoursController#edit', 'cours_edit')
    ->get('POST', '/cours/update', 'CoursController#update', 'cours_update')

    //Note

    ->get('GET', '/note', 'NoteController#index', 'note')
    ->get('POST', '/note/insert', 'NoteController#insert', 'note_insert')
    ->get('POST', '/note/delete', 'NoteController#delete', 'note_delete')
    ->get('GET', '/note/new', 'note/form', 'note_form')
    ->get('GET', '/note/list', 'note/list', 'note_list')
    ->get('POST', '/note/edit', 'NoteController#edit', 'note_edit')
    ->get('POST', '/note/update', 'NoteController#update', 'note_update')


    //Utilisateur

    ->get('GET', '/utilisateur', 'UtilisateurController#index', 'utilisateur')
    ->get('POST', '/utilisateur/show', 'UtilisateurController#show', 'utilisateur_show')
    ->get('POST', '/utilisateur/delete', 'UtilisateurController#delete', 'utilisateur_delete')
    ->get('GET', '/utilisateur/show-data', 'utilisateur/show', 'utilisateur_show_data')
    ->get('POST', '/utilisateur/insert', 'UtilisateurController#insert', 'utilisateur_insert')
    ->get('POST', '/utilisateur/login', 'UtilisateurController#login', 'utilisateur_login')
    ->get('GET', '/utilisateur/new', 'utilisateur/form', 'utilisateur_form')
    ->get('GET', '/utilisateur/list', 'utilisateur/list', 'utilisateur_list')
    ->get('GET', '/user/logout', 'UtilisateurController#logout', 'utilisateur_logout')
    ->get('POST', '/utilisateur/edit', 'UtilisateurController#edit', 'utilisateur_edit')
    ->get('POST', '/utilisateur/update', 'UtilisateurController#update', 'utilisateur_update')

    // Palmares 
    ->get('GET', '/palmares', 'palmares/form', 'palmares_form')

    ->get('GET', '/error', 'error/404', 'not_found')
    ->run();



