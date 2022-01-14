<?php

namespace App\Dao;

use App\Connector;
use App\Model\AnneeAcademique;
use PDO;

class AnneeAcademiqueDao
{
    /**
     * Undocumented function
     *
     * @param AnneeAcademique $anneeAcademique
     * @return boolean
     */
    public static function insertAnnee(AnneeAcademique $anneeAcademique): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("INSERT INTO anneeAcademique(annee_debut, annee_fin, date_debut,
        date_fin, etat, annee_academique) VALUES (:annee_debut, :annee_fin, :date_debut,
        :date_fin, :etat, :annee_academique)");
        $statement->bindValue(':annee_debut', $anneeAcademique->getAnneeDebut(), PDO::PARAM_INT);
        $statement->bindValue(':annee_fin', $anneeAcademique->getAnneeFin(), PDO::PARAM_INT);
        $statement->bindValue(':date_debut', $anneeAcademique->getDateDebut());
        $statement->bindValue(':date_fin', $anneeAcademique->getDateFin());
        $statement->bindValue(':etat', $anneeAcademique->getEtat());
        $statement->bindValue(':annee_academique', $anneeAcademique->getAnneeAcademique());
        return $statement->execute();
    }
    /**
     * Undocumented function
     *
     * @param AnneeAcademique $anneeAcademique
     * @return boolean
     */
    public static function updateAnnee(AnneeAcademique $anneeAcademique): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("UPDATE anneeAcademique SET annee_debut = :annee_debut,
        annee_fin = :annee_fin, date_debut = :date_debut, date_fin = :date_fin, etat = :etat,
        annee_academique = :annee_academique WHERE id = :id");
        $statement->bindValue(':annee_debut', $anneeAcademique->getAnneeDebut(), PDO::PARAM_INT);
        $statement->bindValue(':annee_fin', $anneeAcademique->getAnneeFin(), PDO::PARAM_INT);
        $statement->bindValue(':date_debut', $anneeAcademique->getDateDebut());
        $statement->bindValue(':date_fin', $anneeAcademique->getDateFin());
        $statement->bindValue(':etat', $anneeAcademique->getEtat());
        $statement->bindValue(':annee_academique', $anneeAcademique->getAnneeAcademique());
        $statement->bindValue(':id', $anneeAcademique->getId());
        return $statement->execute();
    }
    /**
     * Undocumented function
     *
     * @param integer $id
     * @return AnneeAcademique|null
     */
    public static function getById(int $id): ?AnneeAcademique
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM anneeAcademique WHERE id = :id");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, AnneeAcademique::class);

        return $statement->fetch();
    }

    public static function getAll()
    {
        $pdo = Connector::getPDO();
        $query = $pdo->query("SELECT * FROM anneeAcademique");
        $years = $query->fetchAll(PDO::FETCH_CLASS, AnneeAcademique::class);
        return $years;
    }

    public static function getAllFilter(?string $criteres)
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM anneeAcademique WHERE annee_debut LIKE %:critere% OR
            annee_fin LIKE %:critere% OR date_debut LIKE %:critere% OR date_fin LIKE %:critere% OR etat
            LIKE %:critere% OR annee_academique LIKE %:critere%");
        $statement->bindValue(':critere', $criteres);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, AnneeAcademique::class);
    }

    /**
     * Undocumented function
     *
     * @param integer|null $id
     * @return boolean|null
     */
    public static function deleteAnne(?int $id): ?bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("DELETE FROM anneeAcademique WHERE id = :id");
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    public static function totalLine(): int
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM anneeAcademique");
        $statement->execute();
        return (int) $statement->fetchColumn();
    }

    public static function insertAnneeForL(AnneeAcademique $anneeAcademique): int
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("INSERT INTO anneeAcademique(annee_debut, annee_fin, date_debut,
        date_fin, etat, annee_academique) VALUES (:annee_debut, :annee_fin, :date_debut,
        :date_fin, :etat, :annee_academique)");
        $statement->bindValue(':annee_debut', $anneeAcademique->getAnneeDebut(), PDO::PARAM_INT);
        $statement->bindValue(':annee_fin', $anneeAcademique->getAnneeFin(), PDO::PARAM_INT);
        $statement->bindValue(':date_debut', $anneeAcademique->getDateDebut());
        $statement->bindValue(':date_fin', $anneeAcademique->getDateFin());
        $statement->bindValue(':etat', $anneeAcademique->getEtat());
        $statement->bindValue(':annee_academique', $anneeAcademique->getAnneeAcademique());
        $statement->execute();
        return $pdo->lastInsertId();
    }
}
