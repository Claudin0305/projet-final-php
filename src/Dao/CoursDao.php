<?php

namespace App\Dao;

use App\Connector;
use App\Model\Cours;
use PDO;

class CoursDao
{
    /**
     * Undocumented function
     *
     * @param Cours $cours
     * @return boolean
     */
    public static function insertCours(Cours $cours): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("INSERT INTO cours(code, nom, filiere, niveau,
        session, prof_id,prof_sup_id, jours, heure_debut,
        heure_fin , etat, coefficient) VALUES(:code, :nom, :filiere, :niveau,
        :session, :prof_id,:prof_sup_id, :jours, :heure_debut,
        :heure_fin , :etat, :coefficient)");
        $statement->bindValue(':code', $cours->getCode());
        $statement->bindValue(':nom', $cours->getNom());
        $statement->bindValue(':filiere', $cours->getFiliere());
        $statement->bindValue(':niveau', $cours->getNiveau());
        $statement->bindValue(':session', $cours->getSession());
        $statement->bindValue(':prof_id', $cours->getProfId());
        $statement->bindValue(':prof_sup_id', $cours->getProfSupId());
        $statement->bindValue(':jours', $cours->getJours());
        $statement->bindValue(':heure_debut', $cours->getHeureDebut());
        $statement->bindValue(':heure_fin', $cours->getHeureFin());
        $statement->bindValue(':etat', $cours->getEtat());
        $statement->bindValue(':coefficient', $cours->getCoefficient());

        return $statement->execute();
    }

    public static function updateCours(Cours $cours): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("UPDATE cours SET code = :code, nom = :nom, filiere = :filiere,
        niveau = :niveau, session = :session, prof_id = :prof_id,
        prof_sup_id = :prof_sup_id, jours = :jours, heure_debut = :heure_debut,
        heure_fin = :heure_fin, etat = :etat, coefficient = :coefficient WHERE id = :id");
        $statement->bindValue(':code', $cours->getCode());
        $statement->bindValue(':nom', $cours->getNom());
        $statement->bindValue(':filiere', $cours->getFiliere());
        $statement->bindValue(':niveau', $cours->getNiveau());
        $statement->bindValue(':session', $cours->getSession());
        $statement->bindValue(':prof_id', $cours->getProfId());
        $statement->bindValue(':prof_sup_id', $cours->getProfSupId());
        $statement->bindValue(':jours', $cours->getJours());
        $statement->bindValue(':heure_debut', $cours->getHeureDebut());
        $statement->bindValue(':heure_fin', $cours->getHeureFin());
        $statement->bindValue(':etat', $cours->getEtat());
        $statement->bindValue(':coefficient', $cours->getCoefficient());
        $statement->bindValue(':id', $cours->getId());

        return $statement->execute();
    }

    public static function getById(int $id): ?Cours
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM cours WHERE id = :id");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Cours::class);

        return $statement->fetch();
    }


    public static function getAll()
    {
        $pdo = Connector::getPDO();
        $query = $pdo->query("SELECT * FROM cours");

        return $query->fetchAll(PDO::FETCH_CLASS, Cours::class);
    }

    public static function getAllFilter(?string $criteres)
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM cours WHERE nom LIKE %:critere% OR
            session LIKE %:critere% OR code LIKE %:critere% OR filiere LIKE %:critere% OR 
            niveau LIKE %:critere% OR  prof_id LIKE %:critere% OR 
            prof_sup_id LIKE %:critere% OR jours LIKE %:critere% OR 
            etat LIKE %:critere%");
        $statement->bindValue(':critere', $criteres);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Cours::class);
    }

    /**
     * Undocumented function
     *
     * @param integer|null $id
     * @return boolean|null
     */
    public static function deleteCours(?int $id): ?bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("DELETE FROM cours WHERE id = :id");
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    /**
     * Undocumented function
     *
     * @return integer
     */
    public static function totalLine(): int
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM cours");
        $statement->execute();

        return (int) $statement->fetchColumn();
    }
}
