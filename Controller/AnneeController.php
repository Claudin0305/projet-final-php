<?php

namespace App\Controller;

session_start();

use App\Dao\AnneeAcademiqueDao;
use App\Dao\EtudiantDao;
use App\Dao\NoteDao;
use App\Model\AnneeAcademique;
use App\Utils\Test;

class AnneeController
{
    public function index()
    {
        $listYear = new AnneeAcademiqueDao();
        if (isset($_SESSION['e_echec'])) {
            unset($_SESSION['e_echec']);
        }
        if (isset($_SESSION['success'])) {
            unset($_SESSION['success']);
        }
        $_SESSION['onYear'] = [];
        $_SESSION['annee'] = [];
        $_SESSION['annee_error'] = [];
        $_SESSION['list_annee'] = $listYear;
        http_response_code(301);
        header('Location: /annee/list');
        die;
    }
    public static function delete()
    {
        extract($_POST);
        if (!empty($id)) {
            if (AnneeAcademiqueDao::deleteAnne((int)$id)) {
                $_SESSION['success'] = 'Suppression effectuer';
                http_response_code(301);
                header('Location: /annee/list');
                die;
            } else {
                $_SESSION['e_sup'] = 'Echec de suppression';
                http_response_code(301);
                header('Location: /annee/list');
                die;
            }
        }
    }
    public static function edit()
    {

        $_SESSION['annee'] = [];
        $_SESSION['annee_error'] = [];
        $anneeAcademique = new AnneeAcademiqueDao();
        extract($_POST);
        $onYear = $anneeAcademique->getById((int)$id);
        if ($onYear !== null) {
            $y = [
                "id" => $onYear->getId(),
                "anneeDebut" => $onYear->getAnneeDebut(),
                "anneeFin" => $onYear->getAnneeFin(),
                "dateDebut" => $onYear->getDateDebut(),
                "dateFin" => $onYear->getDateFin(),
                "etat" => $onYear->getEtat()
            ];
            $_SESSION['onYear'] = $y;
            http_response_code(301);
            header('Location: /annee/new');
            die;
        }
    }
    public static function insert()
    {
        $anneeAcademique = new AnneeAcademique();
        $yearError = [];
        extract($_POST);
        if (Test::startYearCorrect($anneeDebut)) {
            $anneeAcademique->setAnneeDebut((int)filter_var($anneeDebut, FILTER_VALIDATE_INT));
        } else {
            $yearError['e_annee_debut'] = "Année debut incorrect.";
        }
        if (Test::endYearCorrect($anneeDebut, $anneeFin)) {
            $anneeAcademique->setAnneeFin((int) $anneeFin);
        } else {
            $yearError['e_annee_fin'] = "Année de fin incorrect";
        }
        if (Test::yearInDate($anneeDebut, $dateDebut)) {
            $anneeAcademique->setDateDebut($dateDebut);
        } else {
            $yearError['e_date_debut'] = "Date debut incorrect";
        }
        if (Test::yearInDate($anneeFin, $dateFin)) {
            $anneeAcademique->setDateFin($dateFin);
        } else {
            $yearError['e_date_fin'] = "Date fin incorrect";
        }
        if (Test::correctSelect($etat)) {
            if (Test::yearInProgres() !== null && $etat == 'F' || $etat == 'f') {
                $anneeAcademique->setEtat($etat);
            } else {
                $yearError['e_etat'] = 'année en cours existe';
            }
        } else {
            $yearError['e_etat'] = 'Etat invalide!';
        }
        if (!isset($yearError['e_annee_debut']) && !isset($yearError['e_annee_fin'])) {
            if (!Test::yearExiste($anneeDebut . "-" . $anneeFin)) {
                $anneeAcademique->setAnneeAcademique($anneeDebut . "-" . $anneeFin);
            } else {
                $yearError['e_year_existe'] = "L'annee academique existe";
            }
        }
        if (count($yearError) !== 0) {
            $_SESSION['annee'] = $_POST;
            $_SESSION['annee_error'] = $yearError;
            header('Location: /annee/new');
            die;
        } else {
            if (AnneeAcademiqueDao::insertAnnee($anneeAcademique)) {
                $_SESSION['success'] = 'Année academique ajoutée avec succès!';
                $_SESSION['annee'] = null;
                $_SESSION['annee_error'] = null;
                header('Location: /annee');
                die;
            }
        }
    }

    public function update()
    {
        $anneeAcademique = new AnneeAcademique();
        $yearError = [];
        extract($_POST);
        $anneeAcademique->setId($id);
        if (Test::startYearCorrect($anneeDebut)) {
            $anneeAcademique->setAnneeDebut((int)filter_var($anneeDebut, FILTER_VALIDATE_INT));
        } else {
            $yearError['e_annee_debut'] = "Année debut incorrect.";
        }
        if (Test::endYearCorrect($anneeDebut, $anneeFin)) {
            $anneeAcademique->setAnneeFin((int) $anneeFin);
        } else {
            $yearError['e_annee_fin'] = "Année de fin incorrect";
        }
        if (Test::yearInDate($anneeDebut, $dateDebut)) {
            $anneeAcademique->setDateDebut($dateDebut);
        } else {
            $yearError['e_date_debut'] = "Date debut incorrect";
        }
        if (Test::yearInDate($anneeFin, $dateFin)) {
            $anneeAcademique->setDateFin($dateFin);
        } else {
            $yearError['e_date_fin'] = "Date fin incorrect";
        }
        if (Test::correctSelect($etat)) {
            if (Test::yearInProgres() === null) {
                $anneeAcademique->setEtat($etat);
            } else {
                if ($etat === 'O' || $etat === 'o') {
                    if (Test::yearInProgres((int)$id)) {
                        $anneeAcademique->setEtat($etat);
                    } else {
                        $yearError['e_etat'] = 'année en cours existe';
                    }
                } else {
                    $anneeAcademique->setEtat($etat);
                }
            }
        } else {
            $yearError['e_etat'] = 'Etat invalide!';
        }
        if (!isset($yearError['e_annee_debut']) && !isset($yearError['e_annee_fin'])) {
            if (Test::yearExisteForUpdate($anneeDebut . "-" . $anneeFin, $id)) {
                $anneeAcademique->setAnneeAcademique($anneeDebut . "-" . $anneeFin);
            } else {
                $yearError['e_year_existe'] = "L'annee academique existe";
            }
        }
        if (count($yearError) !== 0) {
            $_SESSION['annee'] = $_POST;
            $_SESSION['annee_error'] = $yearError;
            header('Location: /annee/new');
            die;
        } else {
            if (AnneeAcademiqueDao::updateAnnee($anneeAcademique)) {
                $_SESSION['success'] = 'Année academique modifiée avec succès!';
                $_SESSION['annee'] = null;
                $_SESSION['annee_error'] = null;
                header('Location: /annee');
                die;
            }
        }
    }

    public function makePassassion()
    {
        $year = Test::yearInProgres();
        $annee = new AnneeAcademique();
        $errorPass = [];
        if ($year != null) {
            if (EtudiantDao::totalLineById($year->getId()) > 0 && NoteDao::totalLineById($year->getId()) > 0) {
                $etudiants = EtudiantDao::getAllActif($year->getId());
                if (count($etudiants) > 0) {
                    $d = $year->getAnneeDebut() + 1;
                    $f = $year->getAnneeFin() + 1;
                    $annee->setAnneeDebut($d);
                    $annee->setAnneeFin($f);
                    $annee->setEtat('F');
                    $annee->setAnneeAcademique("$d-$f");
                    $annee->setDateDebut("$d" . substr($year->getDateDebut(), 4));
                    $annee->setDateFin("$f" . substr($year->getDateFin(), 4));
                    $id_year = AnneeAcademiqueDao::insertAnneeForL($annee);
                    foreach ($etudiants as $etudiant) {
                        if (NoteDao::calculMoyenne($etudiant->getId(), $year->getId()) >= 65) {
                            switch ($etudiant->getFiliere()) {
                                case "Informatique":
                                case "Education bio":
                                case "Education chimie":
                                case "Education Math-phy":
                                case "Sociologie":
                                case "Psychologie":
                                case "Beaux-arts":
                                case "Environnement":
                                case "Travail social":
                                case "Psycho-éducation":
                                case "Amménagement":
                                case "Science politique":
                                    if ($etudiant->getNiveau() == "EUF") {
                                        $etudiant->setNiveau("L1");
                                    } else if ($etudiant->getNiveau() == "L1") {
                                        $etudiant->setNiveau("L2");
                                    } else if ($etudiant->getNiveau() == "L2") {
                                        $etudiant->setNiveau("L3");
                                    } else if ($etudiant->getNiveau() == "L3") {
                                        $etudiant->setEtat("T");
                                    }
                                    $etudiant->setIdAnneeAcademique($id_year);
                                    if (EtudiantDao::updateEtudiant($etudiant)) {
                                    }
                                    break;
                                case "Agronomie":
                                case "Génie":
                                    if ($etudiant->getNiveau() == "EUF") {
                                        $etudiant->setNiveau("L1");
                                    } else if ($etudiant->getNiveau() == "L1") {
                                        $etudiant->setNiveau("L2");
                                    } else if ($etudiant->getNiveau() == "L2") {
                                        $etudiant->setNiveau("L3");
                                    } else if ($etudiant->getNiveau() == "L3") {
                                        $etudiant->setNiveau("L4");
                                    } else if ($etudiant->getNiveau() == "L4") {
                                        $etudiant->setEtat("T");
                                    }
                                    $etudiant->setIdAnneeAcademique($id_year);
                                    if (EtudiantDao::updateEtudiant($etudiant)) {
                                    }
                                    break;
                                case "Medecine":
                                    if ($etudiant->getNiveau() == "EUF") {
                                        $etudiant->setNiveau("L1");
                                    } else if ($etudiant->getNiveau() == "L1") {
                                        $etudiant->setNiveau("L2");
                                    } else if ($etudiant->getNiveau() == "L2") {
                                        $etudiant->setNiveau("L3");
                                    } else if ($etudiant->getNiveau() == "L3") {
                                        $etudiant->setNiveau("L4");
                                    } else if ($etudiant->getNiveau() == "L4") {
                                        $etudiant->setNiveau("L5");
                                    } else if ($etudiant->getNiveau() == "L5") {
                                        $etudiant->setNiveau("L6");
                                    } else if ($etudiant->getNiveau() == "L6") {
                                        $etudiant->setEtat("T");
                                    }
                                    $etudiant->setIdAnneeAcademique($id_year);
                                    if (EtudiantDao::updateEtudiant($etudiant)) {
                                    }
                                    break;
                            }
                            $year->setEtat('F');
                            AnneeAcademiqueDao::updateAnnee($year);
                            $_SESSION['success'] = 'Passasion effectuer avec succès !';
                            http_response_code(301);
                            header('Location: /annee/list');
                            die;
                        }
                    }
                } else {
                    $errorPass['e_etudiant'] = "Pas d'étudiants actifs";
                    $_SESSION['e_echec'] = $errorPass;
                    http_response_code(301);
                    header('Location: /annee/list');
                    die;
                }
            } else {
                $errorPass['e_note_etu'] = 'Pas de notes ou d\'étudiant pour cette année';
                $_SESSION['e_echec'] = $errorPass;
                http_response_code(301);
                header('Location: /annee/list');
                die;
            }
        } else {
            $errorPass['e_year'] = "Pas d'année en cours";
            $_SESSION['e_echec'] = $errorPass;
            http_response_code(301);
            header('Location: /annee/list');
            die;
        }
    }
}
