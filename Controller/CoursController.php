<?php

namespace App\Controller;

session_start();

use App\Utils\Test;
use App\Dao\CoursDao;
use App\Model\Cours;

class CoursController
{
    public  function index()
    {
        $listCours = new CoursDao();
        if (isset($_SESSION['success'])) {
            unset($_SESSION['success']);
        }
        $_SESSION['onCours'] = [];
        $_SESSION['cours'] = [];
        $_SESSION['cours_error'] = [];
        $_SESSION['list_cours'] = $listCours;
        http_response_code(301);
        header('Location: /cours/list');
        die;
    }

    public static function edit()
    {

        $_SESSION['cours'] = [];
        $_SESSION['cours_error'] = [];
        $cours = new CoursDao;
        extract($_POST);
        $onCours = $cours->getById((int)$id);
        if ($onCours !== null) {
            $debut = explode(',', $onCours->getHeureDebut());
            $fin = explode(',', $onCours->getHeureFin());
            $j = explode(',', $onCours->getJours());
            $t = [];
            foreach ($j as $d) {
                foreach ($debut as $deb) {
                    foreach ($fin as $f) {
                        $t['debut_' . $d] = $deb;
                        $t['fin_' . $d] = $f;
                    }
                }
            }
            $y = [
                "id" => $onCours->getId(),
                'code' => $onCours->getCode(),
                'prof_titulaire' => $onCours->getProfId(),
                'session' => $onCours->getSession(),
                'heure_debut' => $onCours->getHeureDebut(),
                'heure_fin' => $onCours->getHeureFin(),
                'niveau' => $onCours->getNiveau(),
                'filiere' => $onCours->getFiliere(),
                'prof_suppleant' => $onCours->getProfSupId(),
                'coefficient' => $onCours->getCoefficient(),
                'jours' => $j,
                "etat" => $onCours->getEtat(),
                'nom' => $onCours->getNom(),
            ];
            $_SESSION['horaire'] = $t;
            $_SESSION['onCours'] = $y;
            http_response_code(301);
            header('Location: /cours/new');
            die;
        }
    }
    public function delete()
    {
        extract($_POST);
        if (!empty($id)) {
            if (CoursDao::deleteCours((int)$id)) {
                $_SESSION['success'] = 'Suppression effectuer';
                http_response_code(301);
                header('Location: /cours/list');
                die;
            } else {
                $_SESSION['e_sup'] = 'Echec de suppression';
                http_response_code(301);
                header('Location: /cours/list');
                die;
            }
        }
    }
    public function update()
    {
        $cours =  new Cours();
        $coursErrors = [];
        extract($_POST);
        $j = implode(',', $jours);
        $debut = [];
        $fin = [];
        $c_err = 0;
        $cours->setId((int)$id);
        foreach ($jours as $d) {
            if (Test::isCorrectStartTime(${"debut_" . $d})) {
                if (!Test::isCorrectEndTime(${"debut_" . $d}, ${"fin_" . $d})) {
                    $debut[$d] = ${"debut_" . $d};
                    $fin[$d] = ${"fin_" . $d};
                } else {
                    $coursErrors['e_debut_' . $d] = 'Eurreur debut ' . $d;
                    $c_err++;
                }
            } else {
                $coursErrors['e_fin_' . $d] = 'Eurreur fin ' . $d;
                $c_err++;
            }
        }

        if ($c_err === 0) {
            $cours->setJours($j);
            $cours->setHeureDebut(implode(',', $debut));
            $cours->setHeureFin(implode(',', $fin));
        }


        if (filter_var($nom, FILTER_SANITIZE_STRING)) {
            if (Test::nomCoursExisteUpdate($nom, (int)$id)) {
                $cours->setNom($nom);
            } else {
                $coursErrors['e_nom'] = 'Ce cours existe';
            }
        } else {
            $coursErrors['e_nom'] = 'Nom invalide!';
        }

        if (Test::codeCorrect($code)) {
            if (Test::codeCoursExisteUpdate($code, (int)$id)) {
                $cours->setCode($code);
            } else {
                $coursErrors['e_code'] = 'Ce code existe';
            }
        } else {
            $coursErrors['e_code'] = 'Code invalide';
        }

        if (Test::correctSelect($filiere)) {
            $cours->setFiliere($filiere);
        } else {
            $coursErrors['e_filiere'] = 'Choix incorrect';
        }

        if (isset($niveau) && Test::correctSelect($niveau)) {
            $cours->setNiveau($niveau);
        } else {
            $coursErrors['e_niveau'] = 'Choix incorrect';
        }

        if (Test::correctSelect($session)) {
            $cours->setSession($session);
        } else {
            $coursErrors['e_session'] = 'Choix incorrect';
        }

        if (Test::correctSelect($etat)) {
            $cours->setEtat($etat);
        } else {
            $coursErrors['e_etat'] = 'Choix incorrect';
        }
        if (Test::correctSelect($coefficient)) {
            $cours->setCoefficient((int) $coefficient);
        } else {
            $coursErrors['e_coefficient'] = 'Choix incorrect';
        }

        if (Test::correctSelect($prof_titulaire)) {
            $cours->setProfId((int) $prof_titulaire);
        } else {
            $coursErrors['e_prof_titulaire'] = 'Choix incorrect';
        }

        if (Test::correctSelect($prof_suppleant)) {
            if ($prof_suppleant !== 'Aucun') {
                $cours->setProfSupId((int) $prof_suppleant);
            } else {
                $cours->setProfSupId(null);
            }
        } else {
            $coursErrors['e_prof_suppleant'] = 'Choix incorrect';
        }


        if (count($coursErrors) !== 0) {
            $_SESSION['cours'] = $_POST;
            $_SESSION['cours_error'] = $coursErrors;
            header('Location: /cours/new');
            die;
        } else {
            if (CoursDao::updateCours($cours)) {

                $_SESSION['success'] = 'Cours ajouté avec succès!';
                $_SESSION['cours'] = null;
                $_SESSION['cours_error'] = null;
                http_response_code(301);
                header('Location: /cours');
                die;
            }
        }
    }
    public function insert()
    {
        $cours =  new Cours();
        $coursErrors = [];
        extract($_POST);
        $j = implode(',', $jours);
        $debut = [];
        $fin = [];
        $c_err = 0;
        foreach ($jours as $d) {
            if (Test::isCorrectStartTime(${"debut_" . $d})) {
                if (!Test::isCorrectEndTime(${"debut_" . $d}, ${"fin_" . $d})) {
                    $debut[$d] = ${"debut_" . $d};
                    $fin[$d] = ${"fin_" . $d};
                } else {
                    $coursErrors['e_debut_' . $d] = 'Eurreur debut ' . $d;
                    $c_err++;
                }
            } else {
                $coursErrors['e_fin_' . $d] = 'Eurreur fin ' . $d;
                $c_err++;
            }
        }

        if ($c_err === 0) {
            $cours->setJours($j);
            $cours->setHeureDebut(implode(',', $debut));
            $cours->setHeureFin(implode(',', $fin));
        }


        if (filter_var($nom, FILTER_SANITIZE_STRING)) {
            if (Test::coursExiste($nom)) {
                $cours->setNom($nom);
            } else {
                $coursErrors['e_nom'] = 'Ce cours existe';
            }
        } else {
            $coursErrors['e_nom'] = 'Nom invalide!';
        }

        if (Test::correctSelect($filiere)) {
            $cours->setFiliere($filiere);
        } else {
            $coursErrors['e_filiere'] = 'Choix incorrect';
        }

        if (isset($niveau) && Test::correctSelect($niveau)) {
            $cours->setNiveau($niveau);
        } else {
            $coursErrors['e_niveau'] = 'Choix incorrect';
        }

        if (Test::correctSelect($session)) {
            $cours->setSession($session);
        } else {
            $coursErrors['e_session'] = 'Choix incorrect';
        }

        if (Test::correctSelect($etat)) {
            $cours->setEtat($etat);
        } else {
            $coursErrors['e_etat'] = 'Choix incorrect';
        }
        if (Test::correctSelect($coefficient)) {
            $cours->setCoefficient((int) $coefficient);
        } else {
            $coursErrors['e_coefficient'] = 'Choix incorrect';
        }

        if (Test::correctSelect($prof_titulaire)) {
            $cours->setProfId((int) $prof_titulaire);
        } else {
            $coursErrors['e_prof_titulaire'] = 'Choix incorrect';
        }

        if (Test::correctSelect($prof_suppleant)) {
            if ($prof_suppleant !== 'Aucun') {
                $cours->setProfSupId((int) $prof_suppleant);
            } else {
                $cours->setProfSupId(null);
            }
        } else {
            $coursErrors['e_prof_suppleant'] = 'Choix incorrect';
        }

        if (!isset($coursErrors['e_nom'])) {
            $str = substr($nom, 0, 2);
            $long = CoursDao::totalLine();
            $co = Test::generateCode($str, $long);
            while (Test::codeCoursExiste($co)) {
                $co = Test::generateCode($str, $long);
                $long++;
            }

            $cours->setCode($co);
        }


        if (count($coursErrors) !== 0) {
            $_SESSION['cours'] = $_POST;
            $_SESSION['cours_error'] = $coursErrors;
            header('Location: /cours/new');
            die;
        } else {
            if (CoursDao::insertCours($cours)) {

                $_SESSION['success'] = 'Cours ajouté avec succès!';
                $_SESSION['cours'] = null;
                $_SESSION['cours_error'] = null;
                http_response_code(301);
                header('Location: /cours');
                die;
            }
        }
    }
    public function show()
    {
    }
}
