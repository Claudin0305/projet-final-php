<?php

namespace App\Controller;

session_start();

use App\Dao\AnneeAcademiqueDao;
use App\Dao\EtudiantDao;
use App\Model\Etudiant;
use App\Utils\Test;
use \NilPortugues\Validator\Validator;


class EtudiantController
{
    public  function index()
    {
        if (isset($_SESSION['success'])) {
            unset($_SESSION['success']);
        }
        $_SESSION['onEtudiant'] = [];
        $_SESSION['etudiant'] = [];
        $_SESSION['etudiant_error'] = [];
        $_SESSION['list_etudiant'] = new EtudiantDao();
        http_response_code(301);
        header('Location: /etudiant/list');
        die;
    }

    public function edit()
    {
        $_SESSION['etudiant'] = [];
        $_SESSION['etudiant_error'] = [];
        $etudiant = new EtudiantDao;
        $_SESSION['list_annee'] = new AnneeAcademiqueDao();
        extract($_POST);
        $onEtudiant = $etudiant->getById((int)$id);
        if ($onEtudiant !== null) {
            $y = [
                "id" => $onEtudiant->getId(),
                'code' => $onEtudiant->getCode(),
                'prenom' => $onEtudiant->getPrenom(),
                'nom' => $onEtudiant->getNom(),
                'sexe' => $onEtudiant->getSexe(),
                'adresse' => $onEtudiant->getAdresse(),
                'telephone' => $onEtudiant->getTelephone(),
                'lieu_de_naissance' => $onEtudiant->getLieuDeNaissance(),
                'date_de_naissance' => $onEtudiant->getDateDeNaissance(),
                'mail' => $onEtudiant->getEmail(),
                'niveau' => $onEtudiant->getNiveau(),
                'filiere' => $onEtudiant->getFiliere(),
                'memo' => $onEtudiant->getMemo(),
                'etat' => $onEtudiant->getEtat(),
                'nif_or_cin' => $onEtudiant->getNifOrCin(),
                'photo' => $onEtudiant->getPhoto(),
                'personne_de_reference' => $onEtudiant->getPersonneDeReference(),
                'tel_ref' => $onEtudiant->getTelPersonneDeRef(),
                'annee_academique' => $onEtudiant->getAnneeAcademique()
            ];
            $_SESSION['etudiant'] = $y;
            http_response_code(301);
            header('Location: /etudiant/new');
            die;
        }
    }

    public function delete()
    {
        extract($_POST);
        if(!empty($id)){
            if(EtudiantDao::deleteEtudiant((int)$id)){
                $_SESSION['success'] = 'Suppression effectuer';
                http_response_code(301);
                header('Location: /etudiant/list');
                die;
            }else{
                $_SESSION['e_sup'] = 'Echec de suppression';
                http_response_code(301);
                header('Location: /etudiant/list');
                die;
            }
        }
    }
    public function update()
    {
        $string = Validator::create()->isString('userInfo');
        $etudiant = new Etudiant();
        $etudiantErrors = [];
        extract($_POST);
        if (isset($id)) {
            $etudiant = EtudiantDao::getById((int)$id);
        }
        if ($etudiant->getId() !== null) {
            $etudiant->setId($id);
            $etudiant->setPhoto($photo);
            if (Test::validateName($nom)) {
                $etudiant->setNom($nom);
            } else {
                $etudiantErrors['e_nom'] = 'Nom invalide!';
            }
            if (!empty($date_de_naissance) && Test::haveAge($date_de_naissance)) {
                $etudiant->setDateDenaissance($date_de_naissance);
            } else {
                $etudiantErrors['e_date_de_naissance'] = 'Age incorrect!';
            }
            if (Test::validateName($prenom)) {
                $etudiant->setPrenom($prenom);
            } else {
                $etudiantErrors['e_prenom'] = 'Prenom invalide!';
            }
            if (filter_var($mail, FILTER_VALIDATE_EMAIL) !== false) {
                $etudiant->setEmail($mail);
            } else {
                $etudiantErrors['e_email'] = 'mail invalide!';
            }
            if (Test::phoneCorrect($telephone)) {
                $etudiant->setTelephone($telephone);
            } else {
                $etudiantErrors['e_telephone'] = 'Bon format (xxx-xxxx)';
            }
            if (Test::phoneCorrect($tel_ref)) {
                $etudiant->setTelPersonneDeRef($tel_ref);
            } else {
                $etudiantErrors['e_tel_ref'] = 'Bon format (xxx-xxxx)';
            }
            if (Test::correctSelect($sexe)) {
                $etudiant->setSexe($sexe);
            } else {
                $etudiantErrors['e_sexe'] = 'Choix incorrect!';
            }
            if (Test::correctSelect($niveau)) {
                $etudiant->setNiveau($niveau);
            } else {
                $etudiantErrors['e_niveau'] = 'Choix incorrect!';
            }
            if (Test::correctSelect($filiere)) {
                $etudiant->setFiliere($filiere);
            } else {
                $etudiantErrors['e_filiere'] = 'Choix incorrect!';
            }
            if (Test::correctSelect($etat)) {
                $etudiant->setEtat($etat);
            } else {
                $etudiantErrors['e_etat'] = 'Choix incorrect!';
            }
            if (!empty($lieu_de_naissance)) {
                if (Test::validateLieu($lieu_de_naissance)) {
                    $etudiant->setLieuDeNaissance($lieu_de_naissance);
                } else {
                    $etudiantErrors['e_lieu'] = 'Valeur incorrecte!';
                }
            } else {
                $etudiantErrors['e_lieu'] = 'Remplir le champ!';
            }

            if (!empty($personne_de_reference)) {
                if (Test::validateName($personne_de_reference)) {
                    $etudiant->setPersonneDeReference($personne_de_reference);
                } else {
                    $etudiantErrors['e_ref'] = 'Valeur incorrecte!';
                }
            } else {
                $etudiantErrors['e_ref'] = 'Valeur incorrecte!';
            }
            if (!empty($memo)) {
                if ($string->isAlphanumeric()->validate($memo)) {
                    $etudiant->setMemo($memo);
                } else {
                    $etudiantErrors['e_memo'] = 'Valeur incorrect!';
                }
            } else {
                $etudiant->setMemo('');
            }
            if ($string->matchesRegex("#^([0-9]+), ([a-zA-Z0-9\- ]+), ([a-zA-Z0-9\- ]+), ([a-zA-Z0-9\- ]+)$#")
                ->validate($adresse)
            ) {
                $etudiant->setAdresse($adresse);
            } else {
                $etudiantErrors['e_adresse'] = 'no, rue, ville, pays';
            }
            if (Test::validateNifOrCin($nif_or_cin)) {
                if (Test::nifStudentExisteUpdate($nif_or_cin, (int)$id)) {
                    $etudiant->setNifiOrCin($nif_or_cin);
                } else {
                    $etudiantErrors['e_nif_or_cin'] = 'Nif ou existe';
                }
            } else {
                $etudiantErrors['e_nif_or_cin'] = 'Nif ou Cin incorrect';
            }

            if (Test::correctSelect($annee_academique)) {
                $etudiant->setIdAnneeAcademique((int)$annee_academique);
            } else {
                $etudiantErrors['e_annee_academique'] = "Choix invalide!";
            }

            if (Test::codeCorrect($code)) {
                if (Test::codeStudentExisteUpdate($code, (int)$id)) {
                    $etudiant->setCode($code);
                } else {
                    $etudiantErrors['e_code'] = 'Ce code existe!';
                }
            } else {
                $etudiantErrors['e_code'] = 'Code non valide!';
            }


            if (count($etudiantErrors) !== 0) {
                $_SESSION['etudiant'] = $_POST;
                $_SESSION['etudiant_error'] = $etudiantErrors;
                header('Location: /etudiant/new');
                die;
            } else {
                if (EtudiantDao::updateEtudiant($etudiant)) {
                    $_SESSION['success'] = 'Etudiant ajouté avec succès!';
                    $_SESSION['etudiant'] = null;
                    $_SESSION['etudiant_error'] = null;
                    http_response_code(301);
                    header('Location: /etudiant');
                    die;
                }
            }
        }
    }
    public function insert()
    {
        $string = Validator::create()->isString('userInfo');
        $etudiant = new Etudiant();
        $anneeEnCours = Test::yearInProgres();
        $etudiantErrors = [];
        extract($_POST);
        if ($anneeEnCours !== null) {
            $etudiant->setIdAnneeAcademique((int)$anneeEnCours->getId());
        } else {
            $etudiantErrors['e_annee_academique'] = "Pas d'annee academique en cours!";
        }
        if (Test::validateName($nom)) {
            $etudiant->setNom($nom);
        } else {
            $etudiantErrors['e_nom'] = 'Nom invalide!';
        }

        if (!empty($date_de_naissance) && Test::haveAge($date_de_naissance)) {
            $etudiant->setDateDenaissance($date_de_naissance);
        } else {
            $etudiantErrors['e_date_de_naissance'] = 'Age incorrect!';
        }
        if (Test::validateName($prenom)) {
            $etudiant->setPrenom($prenom);
        } else {
            $etudiantErrors['e_prenom'] = 'Prenom invalide!';
        }
        if (filter_var($mail, FILTER_VALIDATE_EMAIL) !== false) {
            $etudiant->setEmail($mail);
        } else {
            $etudiantErrors['e_email'] = 'mail invalide!';
        }
        if (Test::phoneCorrect($telephone)) {
            $etudiant->setTelephone($telephone);
        } else {
            $etudiantErrors['e_telephone'] = 'Bon format (xxx-xxxx)';
        }
        if (Test::phoneCorrect($tel_ref)) {
            $etudiant->setTelPersonneDeRef($tel_ref);
        } else {
            $etudiantErrors['e_tel_ref'] = 'Bon format (xxx-xxxx)';
        }
        if (Test::correctSelect($sexe)) {
            $etudiant->setSexe($sexe);
        } else {
            $etudiantErrors['e_sexe'] = 'Choix incorrect!';
        }
        if (isset($niveau) && Test::correctSelect($niveau)) {
            $etudiant->setNiveau($niveau);
        } else {
            $etudiantErrors['e_niveau'] = 'Choix incorrect!';
        }
        if (Test::correctSelect($filiere)) {
            $etudiant->setFiliere($filiere);
        } else {
            $etudiantErrors['e_filiere'] = 'Choix incorrect!';
        }
        if (Test::correctSelect($etat)) {
            $etudiant->setEtat($etat);
        } else {
            $etudiantErrors['e_etat'] = 'Choix incorrect!';
        }
        if (!empty($lieu_de_naissance)) {
            if (Test::validateLieu($lieu_de_naissance)) {
                $etudiant->setLieuDeNaissance($lieu_de_naissance);
            } else {
                $etudiantErrors['e_lieu'] = 'Valeur incorrecte!';
            }
        } else {
            $etudiantErrors['e_lieu'] = 'Remplir le champ!';
        }
        if (!empty($personne_de_reference)) {
            if (Test::validateName($personne_de_reference)) {
                $etudiant->setPersonneDeReference($personne_de_reference);
            } else {
                $etudiantErrors['e_ref'] = 'Valeur incorrecte!';
            }
        } else {
            $etudiantErrors['e_ref'] = 'Valeur incorrecte!';
        }
        if (!empty($memo)) {
            if ($string->isAlphanumeric()->validate($memo)) {
                $etudiant->setMemo($memo);
            } else {
                $etudiantErrors['e_memo'] = 'Valeur incorrect!';
            }
        } else {
            $etudiant->setMemo('');
        }
        if ($string->matchesRegex("#^([0-9]+), ([a-zA-Z0-9\- ]+), ([a-zA-Z0-9\- ]+), ([a-zA-Z0-9\- ]+)$#")
            ->validate($adresse)
        ) {
            $etudiant->setAdresse($adresse);
        } else {
            $etudiantErrors['e_adresse'] = 'no, rue, ville, pays';
        }
        if (Test::validateNifOrCin($nif_or_cin)) {
            if (Test::nifStudentExiste($nif_or_cin)) {
                $etudiant->setNifiOrCin($nif_or_cin);
            } else {
                $etudiantErrors['e_nif_or_cin'] = 'Nif ou Cin existe';
            }
        } else {
            $etudiantErrors['e_nif_or_cin'] = 'Nif ou Cin incorrect';
        }
        if (Test::correctSelect($categorie)) {
            if ($categorie === 'Ancien') {
                if (Test::codeCorrect($code)) {
                    if (!Test::codeStudentExiste($code)) {
                        $etudiant->setCode($code);
                    } else {
                        $etudiantErrors['e_code'] = 'Ce code existe!';
                    }
                } else {
                    $etudiantErrors['e_code'] = 'Code incorrect!';
                }
            } else {
                if (
                    !isset($etudiantErrors['e_nom']) && !isset($etudiantErrors['e_prenom'])
                    && !isset($etudiantErrors['e_sexe'])
                ) {
                    $str = substr($prenom, 0, 1) . substr($nom, 0, 1) . substr($sexe, 0, 1);
                    $long = EtudiantDao::totalLine();
                    $co = Test::generateCode($str, $long);
                    while (Test::codeStudentExiste($co)) {
                        $co = Test::generateCode($str, $long);
                        $long++;
                    }

                    $etudiant->setCode($co);
                }
            }
        } else {
            $etudiantErrors['e_categorie'] = 'Categorie invalide!';
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
                $etudiant->setPhoto($uniQ . $ext);
            } else {
                $etudiantErrors['e_photo'] = 'La photo est invalide!';
                $etudiantErrors['e'] = $picture['errors'];
            }
        }
        if (count($etudiantErrors) !== 0) {
            $_SESSION['etudiant'] = $_POST;
            $_SESSION['etudiant_error'] = $etudiantErrors;
            header('Location: /etudiant/new');
            die;
        } else {
            if (EtudiantDao::insertEtudiant($etudiant)) {
                if (!empty($tmpName) && !empty($fileName)) {
                    $result = move_uploaded_file($tmpName, $fileName);
                    if ($result) {
                        $_SESSION['p_success'] = 'Photo ajoute';
                    } else {
                        $_SESSION['up_photo_e'] = 'Photo non ajouter. A corriger';
                    }
                }
                $_SESSION['success'] = 'Etudiant ajouté avec succès!';
                $_SESSION['etudiant'] = null;
                $_SESSION['etudiant_error'] = null;
                http_response_code(301);
                header('Location: /etudiant');
                die;
            }
        }
    }
    public function show()
    {
        $etudiantDao = new EtudiantDao();
        extract($_POST);
        if (isset($id)) {
            $etudiant = $etudiantDao->getById((int)$id);
            if ($etudiant != null) {
                $_SESSION['onEtudiant'] = $etudiant;
                http_response_code(301);
                header('Location: /etudiant/show-data');
                die;
            } else {
                $_SESSION['e_etudiant'] = 'Etudiant introuvable!';
                http_response_code(301);
                header('Location: /dahsboard');
                die;
            }
        } else {

            $_SESSION['e_etudiant'] = 'Etudiant introuvable!';
            http_response_code(301);
            header('Location: /dahsboard');
            die;
        }
    }
}
