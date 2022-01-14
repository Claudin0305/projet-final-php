<?php

namespace App\Utils;

use App\Connector;
use App\Dao\CoursDao;
use App\Dao\EtudiantDao;
use App\Model\AnneeAcademique;
use \NilPortugues\Validator\Validator;

class Test
{
    /**
     * Undocumented function
     *
     * @param string $year
     * @return boolean
     */
    public static function startYearCorrect(string $year): bool
    {
        $year = (int) $year;

        $d = new \DateTime();
        $d = (int) $d->format('Y');
        return $year >= 2012 && $year <= $d + 1;
    }

    /**
     * Undocumented function
     *
     * @param string $start
     * @param string $end
     * @return boolean
     */
    public static function endYearCorrect(string $start, string $end): bool
    {
        if (self::startYearCorrect($start)) {
            $end = (int) $end;
            return $end === ((int)$start + 1);
        }

        return false;
    }
    /**
     * Undocumented function
     *
     * @param string $year
     * @param string $date
     * @return boolean
     */
    public static function yearInDate(string $year, string $date): bool
    {
        if ($date != null && $year != null) {
            return strpos($date, $year) !== false;
        }
        return false;
    }
    /**
     * Undocumented function
     *
     * @param string $anneeAcademique
     * @return boolean
     */
    public static function yearExiste(string $anneeAcademique): bool
    {
        $pdo = Connector::getPDO();
        $result = $pdo->exec("SELECT COUNT(*) FROM anneeAcademique WHERE annee_academique = $anneeAcademique");

        return $result !== 0;
    }
    /**
     * Undocumented function
     *
     * @param string $anneeAcademique
     * @param integer $id
     * @return boolean
     */
    public static function yearExisteForUpdate(string $anneeAcademique, int $id): bool
    {
        $pdo = Connector::getPDO();
        $result = $pdo->exec("SELECT COUNT(*) FROM anneeAcademique WHERE annee_academique = '$anneeAcademique' AND id != $id");

        return $result == 0;
    }
    /**
     * Undocumented function
     *
     * @param string $str
     * @return boolean
     */
    public static function correctSelect(string $str): bool
    {
        return $str !== '-------------------';
    }

    public static function yearInProgres(): ?AnneeAcademique
    {
        $pdo = Connector::getPDO();
        $query = $pdo->query("SELECT * FROM anneeAcademique WHERE etat='O' OR etat = 'o'");
        $query->setFetchMode(\PDO::FETCH_CLASS, AnneeAcademique::class);
        $annee = $query->fetch();
        if ($annee === false) {
            return null;
        }
        return $annee;
    }


    /**
     * Undocumented function
     *
     * @param integer $id
     * @return boolean
     */
    public function haveYearInprogress(int $id): bool
    {
        $pdo = Connector::getPDO();
        $count = $pdo->exec("SELECT COUNT(*) FROM anneeAcademique WHERE etat='o' OR etat = 'O' AND id != $id");
        return $count == 0;
    }
    /**
     * Undocumented function
     *
     * @param integer $numberToFormat
     * @param integer $position
     * @return string
     */
    private static function formatByPosition(int $numberToFormat, int $position): string
    {
        $number = "" . $numberToFormat;
        return substr($number, 0, $position) . "-" . substr($number, $position);
    }

    public static function generateCode(string $str, int $count): string
    {
        if ($count >= 0 && $count < 10) {
            return $str . "-000-00" . $count;
        } elseif ($count >= 10 && $count <= 99) {
            return $str . "-000-0" . $count;
        } elseif ($count > 99 && $count <= 999) {
            return $str . "-000-" . $count;
        } elseif ($count > 999 && $count <= 9999) {
            return $str . "-00" . self::formatByPosition($count, 1);
        } elseif ($count > 9999 && $count <= 99999) {
            return $str . "0" . self::formatByPosition($count, 2);
        } else {
            return "" . $count;
        }
    }

    /**
     * Undocumented function
     *
     * @param string $code
     * @return boolean
     */
    public static function codeStudentExiste(string $code): bool
    {
        $pdo = Connector::getPDO();
        $result = $pdo->exec("SELECT COUNT(*) FROM etudiant WHERE code = '$code'");

        return $result !== 0;
    }

    /**
     * Undocumented function
     *
     * @param string $code
     * @return boolean
     */
    public static function codeProfExiste(string $code): bool
    {
        $pdo = Connector::getPDO();
        $result = $pdo->exec("SELECT COUNT(*) FROM professeur WHERE code = '$code'");

        return $result !== 0;
    }

    /**
     * Undocumented function
     *
     * @param string $code
     * @param integer $id
     * @return boolean
     */
    public static function codeStudentExisteUpdate(string $code, int $id): bool
    {
        $pdo = Connector::getPDO();
        $result = $pdo->exec("SELECT COUNT(*) FROM etudiant WHERE code = '$code' AND id != $id");

        return $result == 0;
    }

    /**
     * Undocumented function
     *
     * @param string $code
     * @param integer $id
     * @return boolean
     */
    public static function codeProfExisteUpdate(string $code, int $id): bool
    {
        $pdo = Connector::getPDO();
        $result = $pdo->exec("SELECT COUNT(*) FROM professeur WHERE code = '$code' AND id != $id");

        return $result == 0;
    }


    /**
     * Undocumented function
     *
     * @param string $code
     * @return boolean
     */
    public static function codeCorrect(string $code): bool
    {
        $string = Validator::create()->isString('codeValide');
        return $string->matchesRegex('#^[a-zA-ZéáëËàóòçÉÈÓÒ]{2,3}-[0-9]{3}-[0-9]{3}$#')->validate($code);
    }
    /**
     * Undocumented function
     *
     * @param [type] $nifOrCin
     * @return boolean
     */
    public static function validateNifOrCin($nifOrCin): bool
    {
        $string = Validator::create()->isString('codeValide');

        return $string->matchesRegex('#[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{1}#')->validate($nifOrCin)
            || $string->matchesRegex('#[0-9]{10}#')->validate($nifOrCin);
    }

    public static function phoneCorrect(string $phone): bool
    {
        $string = Validator::create()->isString('phone');
        return $string->matchesRegex('#^[2-4]{1}[0-9]{3}-[0-9]{4}$#')->validate($phone);
    }

    public static function haveAge(string $date, string $type = 'etudiant'): bool
    {
        $d = new \DateTime();
        $d = (int)$d->format('Y');
        $tab = explode('-', $date);
        $age = $d - ((int)$tab[0]);
        if ($type === 'etudiant') {
            return $age >= 18 && $age < 50;
        } else {
            return $age >= 25 && $age < 75;
        }
    }

    public static function uploadFile(string $name): ?array
    {
        $maxSize = 1000000;
        $validExtension = ['.jpg', '.png', '.jpeg'];
        $fileName = '';
        $tmpName = '';
        $fileExt = '';
        $errors = [];
        if (!empty($_FILES[$name]['name']) && isset($_FILES[$name])) {
            if ($_FILES[$name]['error'] == 0) {
                $fileName = $_FILES[$name]['name'];
                $fileExt = '.' . strtolower(substr(strchr($fileName, '.'), 1));
                $tmpName = $_FILES[$name]['tmp_name'];
                if ($_FILES[$name]['size'] <= $maxSize) {
                    if (!in_array($fileExt, $validExtension)) {
                        $errors['e_type'] = 'Type de fichier invalide!';
                    }
                } else {
                    $errors['e_size'] = 'Le fichier est trop gros';
                }
            } else {
                $errors['e_chargement'] = 'Erreur de chargement';
            }

            return [
                'errors' => $errors,
                'tmp_name' => $tmpName,
                'ext' => $fileExt,
                'name' => $fileName

            ];
        }
        return null;
    }

    public static function validateName($name)
    {
        $name = trim($name);
        $string = Validator::create()->isString('name');
        return $string->matchesRegex("#^[a-zA-ZéáëËàóòçÉÈÓÒ' ]+$#")->validate($name) && strlen($name) >= 3;
    }

    public static function validateLieu($name)
    {
        $name = trim($name);
        $string = Validator::create()->isString('name');
        return $string->matchesRegex("#^[a-zA-ZéáëËàóòçÉÈÓÒ0-9\-' ]+$#")->validate($name) && strlen($name) >= 3;
    }

    /**
     * Undocumented function
     *
     * @param string $nif_or_cin
     * @return boolean
     */
    public static function nifStudentExiste(string $nif_or_cin): bool
    {
        $pdo = Connector::getPDO();
        $result = $pdo->exec("SELECT COUNT(*) FROM etudiant WHERE nif_or_cin = '$nif_or_cin'");

        return $result == 0;
    }

    /**
     * Undocumented function
     *
     * @param string $nif_or_cin
     * @return boolean
     */
    public static function nifProfExiste(string $nif_or_cin): bool
    {
        $pdo = Connector::getPDO();
        $result = $pdo->exec("SELECT COUNT(*) FROM professeur WHERE nif_or_cin = '$nif_or_cin'");

        return $result == 0;
    }

    /**
     * Undocumented function
     *
     * @param string $nif_or_cin
     * @param integer $id
     * @return boolean
     */
    public static function nifStudentExisteUpdate(string $nif_or_cin, int $id): bool
    {
        $pdo = Connector::getPDO();
        $result = $pdo->exec("SELECT COUNT(*) FROM etudiant WHERE code = '$nif_or_cin' AND id != $id");

        return $result == 0;
    }

    private static function timeIsOK(string $time): bool
    {
        $string = Validator::create()->isString('time');
        return $string->matchesRegex('#((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))#')->validate($time);
    }

    /**
     * Undocumented function
     *
     * @param string $start
     * @return boolean
     */
    public static function isCorrectStartTime(string $start): bool
    {
        if (self::timeIsOK($start)) {
            if (strpos(strtolower($start), 'am') !== false) {
                $time = substr($start, 0, strpos($start, ':'));
                $t = (int)$time;
                return $t >= 8 && $t <= 12;
            } elseif (strpos(strtolower($start), 'pm') !== false) {
                $time = substr($start, 0, strpos($start, ':'));
                $t = (int)$time;
                return ($t == 12 || $t <= 5);
            }
        }
        return false;
    }

    public static function isCorrectEndTime(string $start, string $end)
    {
        if (self::isCorrectStartTime($start)) {
            $time = substr($start, 0, strpos($start, ':'));
            $t = (int)$time;
            $time2 = substr($end, 0, strpos($end, ':'));
            $t2 = (int)$time2;
            if ($t != 12) {
                return $t2 == $t + 1;
            } else {
                return $t2 >= 1 && $t2 <= 5;
            }
        }

        return false;
    }

    /**
     * Undocumented function
     *
     * @param string $name
     * @return boolean
     */
    public static function coursExiste(string $name): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM cours WHERE nom = '$name'");
        $statement->execute();

        return (int)$statement->fetchColumn() == 0;
    }

    /**
     * Undocumented function
     *
     * @param string $code
     * @return boolean
     */
    public static function codeCoursExiste(string $code): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM cours WHERE code = '$code'");
        $statement->execute();

        return (int)$statement->fetchColumn() != 0;
    }


    /**
     * Undocumented function
     *
     * @param string $pseudo
     * @return boolean
     */
    public static function pseudoExiste(string $pseudo): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM utilisateur WHERE pseudo = :pseudo");
        $statement->bindValue(':pseudo', $pseudo);
        $statement->execute();

        return (int)$statement->fetchColumn() == 0;
    }

    /**
     * Undocumented function
     *
     * @param string $pseudo
     * @param integer $id
     * @return boolean
     */
    public static function pseudoExisteUpdate(string $pseudo, int $id): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM utilisateur WHERE pseudo = :pseudo AND id != :id");
        $statement->bindValue(':pseudo', $pseudo);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return (int)$statement->fetchColumn() == 0;
    }

    /**
     * Undocumented function
     *
     * @param string $code
     * @param integer $id
     * @return boolean
     */
    public static function codeCoursExisteUpdate(string $code, int $id): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM cours WHERE code = '$code' AND id != $id");
        $statement->execute();
        return (int)$statement->fetchColumn() == 0;
    }

    /**
     * Undocumented function
     *
     * @param string $code
     * @param integer $id
     * @return boolean
     */
    public static function nomCoursExisteUpdate(string $nom, int $id): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM cours WHERE nom = '$nom' AND id != $id");

        return (int)$statement->fetchColumn() == 0;
    }


    /**
     * Undocumented function
     *
     * @param integer $id_cours
     * @param integer $id_etudiant
     * @return boolean
     */
    public static function noteExiste(int $id_cours, int $id_etudiant): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM note WHERE id_etudiant = $id_etudiant AND id_cours=$id_cours");
        $statement->execute();

        return (int)$statement->fetchColumn() == 0;
    }

    /**
     * Undocumented function
     *
     * @param integer $id_cours
     * @param integer $id_etudiant
     * @return boolean
     */
    public static function matchCoursNote(int $id_cours, int $id_etudiant): bool
    {
        $etudiant = EtudiantDao::getById($id_etudiant);
        $cours = CoursDao::getById($id_cours);
        return $etudiant->getFiliere() == $cours->getFiliere();
    }

}
