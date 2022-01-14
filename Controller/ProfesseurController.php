<?php

namespace App\Controller;

session_start();

use App\Dao\ProfesseurDao;
use App\Model\Professeur;
use App\Utils\Test;
use \NilPortugues\Validator\Validator;

class ProfesseurController
{
    public  function index()
    {

        if (isset($_SESSION['success'])) {
            unset($_SESSION['success']);
        }
        $_SESSION['onProfesseur'] = [];
        $_SESSION['professeur'] = [];
        $_SESSION['professeur_error'] = [];
        $_SESSION['list_professeur'] = new ProfesseurDao();
        http_response_code(301);
        header('Location: /professeur/list');
        die;
    }

    public function edit()
    {
        $_SESSION['professeur'] = [];
        $_SESSION['professeur_error'] = [];
        $professeurDao = new ProfesseurDao;
        extract($_POST);
        $onProfesseur = $professeurDao->getById((int)$id);
        if ($onProfesseur !== null) {
            $y = [
                "id" => $onProfesseur->getId(),
                'code' => $onProfesseur->getCode(),
                'prenom' => $onProfesseur->getPrenom(),
                'nom' => $onProfesseur->getNom(),
                'sexe' => $onProfesseur->getSexe(),
                'adresse' => $onProfesseur->getAdresse(),
                'telephone' => $onProfesseur->getTelephone(),
                'lieu_de_naissance' => $onProfesseur->getLieuDeNaissance(),
                'date_de_naissance' => $onProfesseur->getDateDeNaissance(),
                'mail' => $onProfesseur->getEmail(),
                'niveau' => $onProfesseur->getNiveau(),
                'filiere' => $onProfesseur->getFiliere(),
                'memo' => $onProfesseur->getMemo(),
                'etat' => $onProfesseur->getEtat(),
                'nif_or_cin' => $onProfesseur->getNifOrCin(),
                'photo' => $onProfesseur->getPhoto(),
                'salaire' => $onProfesseur->getSalaire(),
                'statut' => $onProfesseur->getStatut(),
                'poste' => $onProfesseur->getPoste(),
                'cours' => $onProfesseur->getCoursAEnseigner()
            ];
            $_SESSION['professeur'] = $y;
            http_response_code(301);
            header('Location: /professeur/new');
            die;
        }
    }
    public function delete()
    {
        extract($_POST);
        if (!empty($id)) {
            if (ProfesseurDao::deleteProfesseur((int)$id)) {
                $_SESSION['success'] = 'Suppression effectuer';
                http_response_code(301);
                header('Location: /professeur/list');
                die;
            } else {
                $_SESSION['e_sup'] = 'Echec de suppression';
                http_response_code(301);
                header('Location: /professeur/list');
                die;
            }
        }
    }
    public function update()
    {
        $string = Validator::create()->isString('userInfo');
        $professeur = new Professeur();
        $professeurErrors = [];
        extract($_POST);
        if ($id !== null) {
            $professeur->setId($id);
            $professeur->setPhoto($photo);
            if (isset($filiere) && count($filiere) > 0) {
                $professeur->setFiliere(implode(" ", $filiere));
            } else {
                $professeurErrors['e_filiere'] = 'Vous devez choisir!';
            }
            $sal = (float)$salaire;
            if ($sal > 0) {
                $professeur->setSalaire($sal);
            } else {
                $professeurErrors['e_salaire'] = 'Salaire invalide!';
            }
            if (Test::validateName($nom)) {
                $professeur->setNom($nom);
            } else {
                $professeurErrors['e_nom'] = 'Nom invalide!';
            }

            if (!empty($date_de_naissance) && Test::haveAge($date_de_naissance, 'professeur')) {
                $professeur->setDateDenaissance($date_de_naissance);
            } else {
                $professeurErrors['e_date_de_naissance'] = 'Age incorrect!';
            }
            if (Test::validateName($prenom)) {
                $professeur->setPrenom($prenom);
            } else {
                $professeurErrors['e_prenom'] = 'Prenom invalide!';
            }
            if (filter_var($mail, FILTER_VALIDATE_EMAIL) !== false) {
                $professeur->setEmail($mail);
            } else {
                $professeurErrors['e_email'] = 'mail invalide!';
            }
            if (Test::phoneCorrect($telephone)) {
                $professeur->setTelephone($telephone);
            } else {
                $professeurErrors['e_telephone'] = 'Bon format (xxx-xxxx)';
            }

            if (Test::correctSelect($sexe)) {
                $professeur->setSexe($sexe);
            } else {
                $professeurErrors['e_sexe'] = 'Choix incorrect!';
            }
            if (filter_var($cours, FILTER_SANITIZE_STRING)) {
                $professeur->setCoursAEnseigner($cours);
            } else {
                $professeurErrors['e_cours'] = 'Vous devez le remplir!';
            }
            if (Test::correctSelect($statut)) {
                $professeur->setStatut($statut);
            } else {
                $professeurErrors['e_statut'] = 'Choix incorrect!';
            }
            if (Test::correctSelect($niveau)) {
                $professeur->setNiveau($niveau);
            } else {
                $professeurErrors['e_niveau'] = 'Choix incorrect!';
            }

            if (Test::correctSelect($etat)) {
                $professeur->setEtat($etat);
            } else {
                $professeurErrors['e_etat'] = 'Choix incorrect!';
            }
            if (!empty($lieu_de_naissance)) {
                if (Test::validateLieu($lieu_de_naissance)) {
                    $professeur->setLieuDeNaissance($lieu_de_naissance);
                } else {
                    $professeurErrors['e_lieu'] = 'Valeur incorrecte!';
                }
            } else {
                $professeurErrors['e_lieu'] = 'Remplir le champ!';
            }
            if (!empty($poste)) {
                if (filter_var($personne_de_reference, FILTER_SANITIZE_STRING)) {
                    $professeur->setPoste($personne_de_reference);
                } else {
                    $professeurErrors['e_poste'] = 'Valeur incorrecte!';
                }
            } else {
                $professeur->setPoste('');
            }
            if (!empty($memo)) {
                if ($string->isAlphanumeric()->validate($memo)) {
                    $professeur->setMemo($memo);
                } else {
                    $professeurErrors['e_memo'] = 'Valeur incorrect!';
                }
            } else {
                $professeur->setMemo('');
            }
            if ($string->matchesRegex("#^([0-9]+), ([a-zA-Z0-9\- ]+), ([a-zA-Z0-9\- ]+), ([a-zA-Z0-9\- ]+)$#")
                ->validate($adresse)
            ) {
                $professeur->setAdresse($adresse);
            } else {
                $professeurErrors['e_adresse'] = 'no, rue, ville, pays';
            }
            if (Test::validateNifOrCin($nif_or_cin)) {
                if (Test::nifStudentExisteUpdate($nif_or_cin, (int)$id)) {
                    $professeur->setNifiOrCin($nif_or_cin);
                } else {
                    $professeurErrors['e_nif_or_cin'] = 'Nif ou Cin existe';
                }
            } else {
                $professeurErrors['e_nif_or_cin'] = 'Nif ou Cin incorrect';
            }

            if (Test::codeCorrect($code)) {
                if (Test::codeProfExisteUpdate($code, (int)$id)) {
                    $professeur->setCode($code);
                } else {
                    $professeurErrors['e_code'] = 'Ce code existe';
                }
            } else {
                $professeurErrors['e_code'] = 'Code incorrect!';
            }

            if (count($professeurErrors) !== 0) {
                $_POST['filiere'] = implode(" ", $filiere);
                $_SESSION['professeur'] = $_POST;
                $_SESSION['professeur_error'] = $professeurErrors;
                header('Location: /professeur/new');
                die;
            } else {
                if (ProfesseurDao::updateProfesseur($professeur)) {
                    $_SESSION['success'] = 'Professeur modifié avec succès!';
                    $_SESSION['professeur'] = null;
                    $_SESSION['professeur_error'] = null;
                    http_response_code(301);
                    header('Location: /professeur');
                    die;
                }
            }
        }
    }
    public function insert()
    {
        $string = Validator::create()->isString('userInfo');
        $professeur = new Professeur();
        $professeurErrors = [];
        extract($_POST);
        if (isset($filiere) && count($filiere) > 0) {
            $professeur->setFiliere(implode(" ", $filiere));
        } else {
            $professeurErrors['e_filiere'] = 'Vous devez choisir!';
        }
        $sal = (float)$salaire;
        if ($sal > 0) {
            $professeur->setSalaire($sal);
        } else {
            $professeurErrors['e_salaire'] = 'Salaire invalide!';
        }
        if (Test::validateName($nom)) {
            $professeur->setNom($nom);
        } else {
            $professeurErrors['e_nom'] = 'Nom invalide!';
        }

        if (!empty($date_de_naissance) && Test::haveAge($date_de_naissance, 'professeur')) {
            $professeur->setDateDenaissance($date_de_naissance);
        } else {
            $professeurErrors['e_date_de_naissance'] = 'Age incorrect!';
        }
        if (Test::validateName($prenom)) {
            $professeur->setPrenom($prenom);
        } else {
            $professeurErrors['e_prenom'] = 'Prenom invalide!';
        }
        if (filter_var($mail, FILTER_VALIDATE_EMAIL) !== false) {
            $professeur->setEmail($mail);
        } else {
            $professeurErrors['e_email'] = 'mail invalide!';
        }
        if (Test::phoneCorrect($telephone)) {
            $professeur->setTelephone($telephone);
        } else {
            $professeurErrors['e_telephone'] = 'Bon format (xxx-xxxx)';
        }

        if (Test::correctSelect($sexe)) {
            $professeur->setSexe($sexe);
        } else {
            $professeurErrors['e_sexe'] = 'Choix incorrect!';
        }
        if (filter_var($cours, FILTER_SANITIZE_STRING)) {
            $professeur->setCoursAEnseigner($cours);
        } else {
            $professeurErrors['e_cours'] = 'Vous devez le remplir!';
        }
        if (Test::correctSelect($statut)) {
            $professeur->setStatut($statut);
        } else {
            $professeurErrors['e_statut'] = 'Choix incorrect!';
        }
        if (Test::correctSelect($niveau)) {
            $professeur->setNiveau($niveau);
        } else {
            $professeurErrors['e_niveau'] = 'Choix incorrect!';
        }

        if (Test::correctSelect($etat)) {
            $professeur->setEtat($etat);
        } else {
            $professeurErrors['e_etat'] = 'Choix incorrect!';
        }
        if (!empty($lieu_de_naissance)) {
            if (Test::validateLieu($lieu_de_naissance)) {
                $professeur->setLieuDeNaissance($lieu_de_naissance);
            } else {
                $professeurErrors['e_lieu'] = 'Valeur incorrecte!';
            }
        } else {
            $professeurErrors['e_lieu'] = 'Remplir le champ!';
        }
        if (!empty($poste)) {
            if (filter_var($personne_de_reference, FILTER_SANITIZE_STRING)) {
                $professeur->setPoste($personne_de_reference);
            } else {
                $professeurErrors['e_poste'] = 'Valeur incorrecte!';
            }
        } else {
            $professeur->setPoste('');
        }
        if (!empty($memo)) {
            if ($string->isAlphanumeric()->validate($memo)) {
                $professeur->setMemo($memo);
            } else {
                $professeurErrors['e_memo'] = 'Valeur incorrect!';
            }
        } else {
            $professeur->setMemo('');
        }
        if ($string->matchesRegex("#^([0-9]+), ([a-zA-Z0-9\- ]+), ([a-zA-Z0-9\- ]+), ([a-zA-Z0-9\- ]+)$#")
            ->validate($adresse)
        ) {
            $professeur->setAdresse($adresse);
        } else {
            $professeurErrors['e_adresse'] = 'no, rue, ville, pays';
        }
        if (Test::validateNifOrCin($nif_or_cin)) {
            if (Test::nifProfExiste($nif_or_cin)) {
                $professeur->setNifiOrCin($nif_or_cin);
            } else {
                $professeurErrors['e_nif_or_cin'] = 'Nif ou Cin existe';
            }
        } else {
            $professeurErrors['e_nif_or_cin'] = 'Nif ou Cin incorrect';
        }
        if (Test::correctSelect($categorie)) {
            if ($categorie === 'Ancien') {
                if (Test::codeCorrect($code)) {
                    if (!Test::codeProfExiste($code)) {
                        $professeur->setCode($code);
                    } else {
                        $professeurErrors['e_code'] = 'Ce code existe!';
                    }
                } else {
                    $professeurErrors['e_code'] = 'Code incorrect!';
                }
            } else {
                if (
                    !isset($professeurErrors['e_nom']) && !isset($professeurErrors['e_prenom'])
                    && !isset($professeurErrors['e_sexe'])
                ) {
                    $str = substr($prenom, 0, 1) . substr($nom, 0, 1) . substr($sexe, 0, 1);
                    $long = ProfesseurDao::totalLine();
                    $co = Test::generateCode($str, $long);
                    while (Test::codeStudentExiste($co)) {
                        $co = Test::generateCode($str, $long);
                        $long++;
                    }

                    $professeur->setCode($co);
                }
            }
        } else {
            $professeurErrors['e_categorie'] = 'Categorie invalide!';
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
                $professeur->setPhoto($uniQ . $ext);
            } else {
                $professeurErrors['e_photo'] = 'La photo est invalide!';
                $professeurErrors['e'] = $picture['errors'];
            }
        }
        if (count($professeurErrors) !== 0) {
            $_SESSION['professeur'] = $_POST;
            $_SESSION['professeur_error'] = $professeurErrors;
            header('Location: /professeur/new');
            die;
        } else {
            if (ProfesseurDao::insertProfesseur($professeur)) {
                if (!empty($tmpName) && !empty($fileName)) {
                    $result = move_uploaded_file($tmpName, $fileName);
                    if ($result) {
                        $_SESSION['p_success'] = 'Photo ajoute';
                    } else {
                        $_SESSION['up_photo_e'] = 'Photo non ajouter. A corriger';
                    }
                }
                $_SESSION['success'] = 'Professeur ajouté avec succès!';
                $_SESSION['professeur'] = null;
                $_SESSION['professeur_error'] = null;
                http_response_code(301);
                header('Location: /professeur');
                die;
            }
        }
    }
    public function show()
    {
        $professeurDao = new ProfesseurDao();
        extract($_POST);
        if (isset($id)) {
            $professeur = $professeurDao->getById((int)$id);
            if ($professeur != null) {
                $_SESSION['onProfesseur'] = $professeur;
                http_response_code(301);
                header('Location: /professeur/show-data');
                die;
            } else {
                $_SESSION['e_professeur'] = 'Professeur introuvable!';
                http_response_code(301);
                header('Location: /dahsboard');
                die;
            }
        } else {

            $_SESSION['e_professeur'] = 'Professeur introuvable!';
            http_response_code(301);
            header('Location: /dahsboard');
            die;
        }
    }
}
