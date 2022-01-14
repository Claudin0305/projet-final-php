<?php

namespace App\Controller;

session_start();

use App\Dao\CoursDao;
use App\Dao\NoteDao;
use App\Model\Note;
use App\Utils\Test;

class NoteController
{
    public  function index()
    {
        if (isset($_SESSION['success'])) {
            unset($_SESSION['success']);
        }
        $listNotes = new NoteDao();
        $_SESSION['onNote'] = [];
        $_SESSION['note'] = [];
        $_SESSION['note_error'] = [];
        $_SESSION['list_note'] = $listNotes;
        http_response_code(301);
        header('Location: /note/list');
        die;
    }

    public function edit()
    {
        $_SESSION['cours'] = [];
        $_SESSION['cours_error'] = [];
        $note = new NoteDao();
        extract($_POST);
        $onNote = $note->getById((int)$id);
        if ($onNote !== null) {
            $y = [
                "id" => $onNote->getId(),
                'code_cours' => $onNote->getIdCours(),
                'code_etudiant' => $onNote->getIdEtudiant(),
                'note' => $onNote->getNote(),
                'annee' => $onNote->getIdAnne(),
                'session' => $onNote->getSession()
            ];
            $_SESSION['onNote'] = $y;
            http_response_code(301);
            header('Location: /note/new');
            die;
        }
    }

    public function delete()
    {
        extract($_POST);
        if (!empty($id)) {
            if (NoteDao::deleteNote((int)$id)) {
                $_SESSION['success'] = 'Suppression effectuer';
                http_response_code(301);
                header('Location: /note/list');
                die;
            } else {
                $_SESSION['e_sup'] = 'Echec de suppression';
                http_response_code(301);
                header('Location: /note/list');
                die;
            }
        }
    }
    public function update()
    {
        $noteC =  new Note();
        $noteErrors = [];
        extract($_POST);

        if (filter_var($note, FILTER_SANITIZE_NUMBER_FLOAT)) {
            $d = (float)$note;
            if ($d >= 0 && $d <= 100) {
                $noteC->setNote($d);
            } else {
                $noteErrors['e_note'] = 'Invalide (0 - 100)';
            }
        } else {
            $noteErrors['e_note'] = 'Note invalide';
        }

        if (Test::correctSelect($annee)) {
            $noteC->setAnneeAcademique((int) $annee);
        } else {
            $noteErrors['e_annee'] = 'Choix incorrect!';
        }
        if (Test::correctSelect($code_cours)) {
            $noteC->setIdCours((int)$code_cours);
            $cours = CoursDao::getById((int)$code_cours);
            if ($cours !== null) {
                if ($cours->getSession() == $session) {
                    $noteC->setSession($session);
                } else {
                    $noteErrors['e_session'] = 'Cours et session ne correspondent';
                }
            } else {
                $noteErrors['e_code_cours'] = 'Cours invalide';
            }
        } else {
            $noteErrors['e_code_cours'] = 'Choix incorrect';
        }
        if (Test::correctSelect($code_etudiant)) {
            $noteC->setIdEtudiant((int)$code_etudiant);
        } else {
            $noteErrors['e_code_etudiant'] = 'Choix incorrect!';
        }

        if(!isset($noteErrors['e_code_etudiant']) && !isset($noteErrors['e_code_cours'])){
            if(!Test::matchCoursNote((int)$code_cours, (int)$code_etudiant)){
                $noteErrors['e_cours_filiere'] = 'La filiere du cours ne correspond pas à celle de l\'etudiant';
            }
        }

        if (count($noteErrors) !== 0) {
            $_SESSION['note'] = $_POST;
            $_SESSION['note_error'] = $noteErrors;
            header('Location: /note/new');
            die;
        } else {
            if (NoteDao::updateNote($noteC)) {

                $_SESSION['success'] = 'Note ajoutée avec succès!';
                $_SESSION['note'] = null;
                $_SESSION['note_error'] = null;
                http_response_code(301);
                header('Location: /note');
                die;
            }
        }
    }
    public function insert()
    {
        $noteC =  new Note();
        $noteErrors = [];
        extract($_POST);

        if (filter_var($note, FILTER_SANITIZE_NUMBER_FLOAT)) {
            $d = (float)$note;
            if ($d >= 0 && $d <= 100) {
                $noteC->setNote($d);
            } else {
                $noteErrors['e_note'] = 'Invalide (0 - 100)';
            }
        } else {
            $noteErrors['e_note'] = 'Note invalide';
        }

        if (Test::correctSelect($annee)) {
            $noteC->setAnneeAcademique((int) $annee);
        } else {
            $noteErrors['e_annee'] = 'Choix incorrect!';
        }
        if (Test::correctSelect($code_cours)) {
            $noteC->setIdCours((int)$code_cours);
            $cours = CoursDao::getById((int)$code_cours);
            if ($cours !== null) {
                if ($cours->getSession() == $session) {
                    $noteC->setSession($session);
                } else {
                    $noteErrors['e_session'] = 'Cours et session ne correspondent';
                }
            } else {
                $noteErrors['e_code_cours'] = 'Cours invalide';
            }
        } else {
            $noteErrors['e_code_cours'] = 'Choix incorrect';
        }
        if (Test::correctSelect($code_etudiant)) {
            $noteC->setIdEtudiant((int)$code_etudiant);
        } else {
            $noteErrors['e_code_etudiant'] = 'Choix incorrect!';
        }

        if (!isset($noteErrors['e_code_etudiant']) && !isset($noteErrors['e_code_cours'])) {
            if (!Test::noteExiste((int)$code_cours, (int)$code_etudiant)) {
                $noteErrors['e_note_existe'] = 'Note existe';
            }
        }
        if (!isset($noteErrors['e_code_etudiant']) && !isset($noteErrors['e_code_cours'])) {
            if (!Test::matchCoursNote((int)$code_cours, (int)$code_etudiant)) {
                $noteErrors['e_cours_filiere'] = 'La filiere du cours ne correspond pas à celle de l\'etudiant';
            }
        }
        if (count($noteErrors) !== 0) {
            $_SESSION['note'] = $_POST;
            $_SESSION['note_error'] = $noteErrors;
            header('Location: /note/new');
            die;
        } else {
            if (NoteDao::insertNote($noteC)) {

                $_SESSION['success'] = 'Note ajoutée avec succès!';
                $_SESSION['note'] = null;
                $_SESSION['note_error'] = null;
                http_response_code(301);
                header('Location: /note');
                die;
            }
        }
    }
}
