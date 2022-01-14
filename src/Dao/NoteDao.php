<?php

namespace App\Dao;

use App\Connector;
use App\Model\Note;
use PDO;

class NoteDao
{

    /**
     * Undocumented function
     *
     * @param Note $note
     * @return boolean
     */
    public static function insertNote(Note $note): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("INSERT INTO note(session, id_etudiant,
        id_cours, id_annee_academique, note) VALUES(:session, :id_etudiant, :id_cours,
        :id_annee_academique, :note)");
        $statement->bindValue(':session', $note->getSession());
        $statement->bindValue(':id_cours', $note->getIdCours());
        $statement->bindValue(':id_etudiant', $note->getIdEtudiant());
        $statement->bindValue(':id_annee_academique', $note->getIdAnne());
        $statement->bindValue(':note', $note->getNote());

        return $statement->execute();
    }
    /**
     * Undocumented function
     *
     * @param Note $note
     * @return boolean
     */
    public static function updateNote(Note $note): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("UPDATE note SET session = :session, id_etudiant= :id_etudiant,
        id_cours = :id_cours, id_annee_academique = :id_annee_academique, note = :note
        WHERE id = :id");
        $statement->bindValue(':session', $note->getSession());
        $statement->bindValue(':id_cours', $note->getIdCours());
        $statement->bindValue(':id_etudiant', $note->getIdEtudiant());
        $statement->bindValue(':id_annee_academique', $note->getIdAnne());
        $statement->bindValue(':note', $note->getNote());
        $statement->bindValue(':id', $note->getId());

        return $statement->execute();
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return Note|null
     */
    public static function getById(int $id): ?Note
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM note WHERE id = :id");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Note::class);

        return $statement->fetch();
    }

    public static function getAll()
    {
        $pdo = Connector::getPDO();
        $query = $pdo->query("SELECT * FROM note");

        return $query->fetchAll(PDO::FETCH_CLASS, Note::class);
    }

    public static function getAllFilter(?string $criteres)
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM note WHERE note LIKE %:critere% OR
            session LIKE %:critere% OR id_cours LIKE %:critere% OR id_etudiant LIKE %:critere% OR 
            id_annee_academique LIKE %:critere%");
        $statement->bindValue(':critere', $criteres);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Note::class);
    }

    /**
     * Undocumented function
     *
     * @param integer|null $id
     * @return boolean|null
     */
    public static function deleteNote(?int $id): ?bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("DELETE FROM note WHERE id = :id");
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    public static function totalLine(): int
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM note");
        $statement->execute();
        return (int) $statement->fetchColumn();
    }

    private static function getNoteByIdYear(?int $id_etudiant, ?int $id_annee)
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM note WHERE id_etudiant = :id_etudiant AND
        id_annee_academique = :id_annee");
        $statement->bindValue(':id_etudiant', $id_etudiant);
        $statement->bindValue(':id_annee', $id_annee);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, Note::class);
    }

    private static function calculTotalNote(int $id_etudiant, int $id_annee):float{
        $s = 0;
        foreach(self::getNoteByIdYear($id_etudiant, $id_annee) as $note){
            $s += $note->getNote() * CoursDao::getById($note->getIdCours())->getCoefficient();
        }
        return $s;
    }

    private static function calculTotalCoefficient(int $id_etudiant, int $id_annee): int
    {
        $s = 0;
        foreach (self::getNoteByIdYear($id_etudiant, $id_annee) as $note) {
            $s +=  CoursDao::getById($note->getIdCours())->getCoefficient();
        }
        return $s;
    }

    public static function calculMoyenne(int $id_etudiant, int $id_annee):float{
        $note = self::calculTotalNote($id_etudiant, $id_annee);
        $coef = self::calculTotalCoefficient($id_etudiant, $id_annee);
        if($coef >0){
            return $note / $coef;
        }
        return 0;
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return integer
     */
    public static function totalLineById(int $id): int
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM note WHERE id_annee_academique = :id");
        $statement->bindValue(':id', $id);
        $statement->execute();

        return (int) $statement->fetchColumn();
    }

}
