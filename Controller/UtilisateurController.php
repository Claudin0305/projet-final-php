<?php

namespace App\Controller;

use App\Dao\UtilisateurDao;
use App\Model\Utilisateur;
use App\Utils\Test;
use \NilPortugues\Validator\Validator;

session_start();

class UtilisateurController
{
    public  function index()
    {

        if (isset($_SESSION['success'])) {
            unset($_SESSION['success']);
        }
        $_SESSION['onUtilisateur'] = [];
        $_SESSION['utilisateur'] = [];
        $_SESSION['utilisateur_error'] = [];
        $_SESSION['list_utilisateur'] = new UtilisateurDao();
        http_response_code(301);
        header('Location: /utilisateur/list');
        die;
    }
    public function edit()
    {
        $_SESSION['utilisateur'] = [];
        $_SESSION['utilisateur_error'] = [];
        $utilisateurDao = new UtilisateurDao;
        extract($_POST);
        $onUtilisateur = $utilisateurDao->getById((int)$id);
        if ($onUtilisateur !== null) {
            $y = [
                "id" => $onUtilisateur->getId(),
                'prenom' => $onUtilisateur->getPrenom(),
                'nom' => $onUtilisateur->getNom(),
                'pseudo' => $onUtilisateur->getPseudo(),
                'etat' => $onUtilisateur->getEtat(),
                'photo' => $onUtilisateur->getPhoto(),
                'poste' => $onUtilisateur->getPoste(),
                'pas' => $onUtilisateur->getPassWord(),
                'module' => explode(',', $onUtilisateur->getModules())
            ];
            $_SESSION['utilisateur'] = $y;
            http_response_code(301);
            header('Location: /utilisateur/new');
            die;
        }
    }
    public function delete()
    {
        extract($_POST);
        if (!empty($id)) {
            if (UtilisateurDao::deleteUser((int)$id)) {
                $_SESSION['success'] = 'Suppression effectuer';
                http_response_code(301);
                header('Location: /utilisateur/list');
                die;
            } else {
                $_SESSION['e_sup'] = 'Echec de suppression';
                http_response_code(301);
                header('Location: /utilisateur/list');
                die;
            }
        }
    }

    public function update()
    {
        $string = Validator::create()->isString('userInfo');
        $utilisateur = new Utilisateur;
        $utilisateurErrors = [];
        extract($_POST);
        $utilisateur->setId($id);
        $utilisateur->setPassword($pas);
        if (Test::validateName($nom)) {
            $utilisateur->setNom($nom);
        } else {
            $utilisateurErrors['e_nom'] = 'Nom invalide!';
        }

        if (Test::validateName($prenom)) {
            $utilisateur->setPrenom($prenom);
        } else {
            $utilisateurErrors['e_prenom'] = 'Prenom invalide!';
        }

        if (Test::correctSelect($etat)) {
            $utilisateur->setEtat($etat);
        } else {
            $utilisateurErrors['e_etat'] = 'Choix incorrect!';
        }

        if (!empty($poste)) {
            if (filter_var($poste, FILTER_SANITIZE_STRING)) {
                $utilisateur->setPoste($poste);
            } else {
                $utilisateurErrors['e_poste'] = 'Valeur incorrecte!';
            }
        } else {
            $utilisateur->setPoste('');
        }
        if (filter_var($pseudo, FILTER_SANITIZE_STRING)) {
            if (strlen($pseudo) >= 3) {
                if (Test::pseudoExisteUpdate($pseudo, (int)$id)) {
                    $utilisateur->setPseudo($pseudo);
                } else {
                    $utilisateurErrors['e_pseudo'] = 'Pseudo existe!';
                }
            } else {
                $utilisateurErrors['e_pseudo'] = 'Min 3 caractères';
            }
        } else {
            $utilisateurErrors['e_pseudo'] = 'Pseudo invalide';
        }

        if (isset($module)) {
            $utilisateur->setModules(implode(',', $module));
        } else {
            $utilisateurErrors['e_module'] = 'Vous devez choisir un module';
        }

        $utilisateur->setPhoto($photo);
        if (count($utilisateurErrors) !== 0) {
            $_SESSION['utilisateur'] = $_POST;
            $_SESSION['utilisateur_error'] = $utilisateurErrors;
            header('Location: /utilisateur/new');
            die;
        } else {
            if (UtilisateurDao::updateUser($utilisateur)) {

                $_SESSION['success'] = 'Utilisateur ajouté avec succès!';
                $_SESSION['utilisateur'] = null;
                $_SESSION['utilisateur_error'] = null;
                http_response_code(301);
                header('Location: /utilisateur');
                die;
            }
        }
    }
    public function insert()
    {
        $string = Validator::create()->isString('userInfo');
        $utilisateur = new Utilisateur;
        $utilisateurErrors = [];
        extract($_POST);
        if (Test::validateName($nom)) {
            $utilisateur->setNom($nom);
        } else {
            $utilisateurErrors['e_nom'] = 'Nom invalide!';
        }

        if (Test::validateName($prenom)) {
            $utilisateur->setPrenom($prenom);
        } else {
            $utilisateurErrors['e_prenom'] = 'Prenom invalide!';
        }

        if (Test::correctSelect($etat)) {
            $utilisateur->setEtat($etat);
        } else {
            $utilisateurErrors['e_etat'] = 'Choix incorrect!';
        }

        if (!empty($poste)) {
            if (filter_var($poste, FILTER_SANITIZE_STRING)) {
                $utilisateur->setPoste($poste);
            } else {
                $utilisateurErrors['e_poste'] = 'Valeur incorrecte!';
            }
        } else {
            $utilisateur->setPoste('');
        }
        if (filter_var($pseudo, FILTER_SANITIZE_STRING)) {
            if (strlen($pseudo) >= 3) {
                if (Test::pseudoExiste($pseudo)) {
                    $utilisateur->setPseudo($pseudo);
                } else {
                    $utilisateurErrors['e_pseudo'] = 'Pseudo existe!';
                }
            } else {
                $utilisateurErrors['e_pseudo'] = 'Min 3 caractères';
            }
        } else {
            $utilisateurErrors['e_pseudo'] = 'Pseudo invalide';
        }
        if (!empty($pas) && !empty($r_pas)) {
            if ($pas === $r_pas) {
                if (strlen($pas) >= 6) {
                    $utilisateur->setPassword(password_hash($pas, PASSWORD_DEFAULT));
                } else {

                    $utilisateurErrors['e_pas'] = 'Min 6 caractères';
                }
            } else {
                $utilisateurErrors['e_pas'] = 'Password non identique!';
            }
        } else {
            $utilisateurErrors['e_pas'] = 'password invalide';
        }
        if (isset($module)) {
            $utilisateur->setModules(implode(',', $module));
        } else {
            $utilisateurErrors['e_module'] = 'Vous devez choisir un module';
        }

        //Photo
        $fileName = '';
        $tmpName = '';
        $ext = '';
        $uniQ = md5(uniqid(rand(), true));
        $picture = Test::uploadFile('photo');
        if ($picture !== null) {
            $err = $picture['errors'];
            if (count($err) == 0) {
                $tmpName = $picture['tmp_name'];
                $ext = $picture['ext'];
                $fileName = 'pictures/' . $uniQ . $ext;
                $utilisateur->setPhoto($uniQ . $ext);
            } else {
                $utilisateurErrors['e_photo'] = 'La photo est invalide!';
                $utilisateurErrors['e'] = $picture['errors'];
            }
        }
        if (count($utilisateurErrors) !== 0) {
            $_SESSION['utilisateur'] = $_POST;
            $_SESSION['utilisateur_error'] = $utilisateurErrors;
            header('Location: /utilisateur/new');
            die;
        } else {
            if (UtilisateurDao::insertUser($utilisateur)) {
                if (!empty($tmpName) && !empty($fileName)) {
                    $result = move_uploaded_file($tmpName, $fileName);
                    if ($result) {
                        $_SESSION['p_success'] = 'Photo ajoute';
                    } else {
                        $_SESSION['up_photo_e'] = 'Photo non ajouter. A corriger';
                    }
                }
                $_SESSION['success'] = 'Utilisateur ajouté avec succès!';
                $_SESSION['utilisateur'] = null;
                $_SESSION['utilisateur_error'] = null;
                http_response_code(301);
                header('Location: /utilisateur');
                die;
            }
        }
    }
    public function show()
    {
        $utilisateurDao = new UtilisateurDao();
        extract($_POST);
        if (isset($id)) {
            $utilisateur = $utilisateurDao->getById((int)$id);
            if ($utilisateur != null) {
                $_SESSION['onUtilisateur'] = $utilisateur;
                http_response_code(301);
                header('Location: /utilisateur/show-data');
                die;
            } else {
                $_SESSION['e_utilisateur'] = 'Utilisateur introuvable!';
                http_response_code(301);
                header('Location: /dahsboard');
                die;
            }
        } else {

            $_SESSION['e_utilisateur'] = 'Utilisateur introuvable!';
            http_response_code(301);
            header('Location: /dahsboard');
            die;
        }
    }

    public function login()
    {
        extract($_POST);
        $errors = [];
        $utilisateur = UtilisateurDao::getByPseudo($pseudo);
        if ($utilisateur != null) {
            if (password_verify($password, $utilisateur->getPassWord())) {
                if ($utilisateur->getEtat() == 'Actif') {
                    $_SESSION['user'] = $utilisateur;
                    if (isset($_SESSION['e_login'])) {
                        unset($_SESSION['e_login']);
                    }
                    http_response_code(301);
                    header('Location: /dashboard');
                    die;
                } else {
                    $errors['e_etat'] = 'Votre compte est innactif!';
                }
            } else {
                $errors['e_identite'] = 'Pseudo ou password invalide!';
            }
        } else {
            $errors['e_pseudo'] = 'Utilisateur introuvable!';
        }
        if (count($errors) > 0) {
            $_SESSION['e_login'] = $errors;
            http_response_code(301);
            header('Location: /');
            die;
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            if (isset($_SESSION['e_login'])) {
                unset($_SESSION['e_login']);
            }
            http_response_code(301);
            header('Location: /');
            die;
        }
    }
}
