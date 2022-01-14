<?php

namespace App\Dao;

use App\Connector;
use App\Model\Utilisateur;
use PDO;

class UtilisateurDao
{
    /**
     * Undocumented function
     *
     * @param Utilisateur $utilisateur
     * @return boolean
     */
    public static function insertUser(Utilisateur $utilisateur): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("INSERT INTO utilisateur(
            nom,
            prenom,
            poste,
            pseudo,
            passWord,
            etat,
            photo,
            modules) VALUES(
            :nom,
            :prenom,
            :poste,
            :pseudo,
            :passWord,
            :etat,
            :photo,
            :modules
            )");

        $statement->bindValue(':nom', $utilisateur->getNom());
        $statement->bindValue(':prenom', $utilisateur->getPrenom());
        $statement->bindValue(':poste', $utilisateur->getPoste());
        $statement->bindValue(':pseudo', $utilisateur->getPseudo());
        $statement->bindValue(':passWord', $utilisateur->getPassWord());
        $statement->bindValue(':etat', $utilisateur->getEtat());
        $statement->bindValue(':photo', $utilisateur->getPhoto());
        $statement->bindValue(':modules', $utilisateur->getModules());

        return $statement->execute();
    }
    /**
     * Undocumented function
     *
     * @param Utilisateur $utilisateur
     * @return boolean
     */
    public static function updateUser(Utilisateur $utilisateur): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom,
            poste = :poste, pseudo = :pseudo, passWord = :passWord, etat = :etat,
            photo = :photo, modules = :modules WHERE id = :id
            ");

        $statement->bindValue(':nom', $utilisateur->getNom());
        $statement->bindValue(':prenom', $utilisateur->getPrenom());
        $statement->bindValue(':poste', $utilisateur->getPoste());
        $statement->bindValue(':pseudo', $utilisateur->getPseudo());
        $statement->bindValue(':passWord', $utilisateur->getPassWord());
        $statement->bindValue(':etat', $utilisateur->getEtat());
        $statement->bindValue(':photo', $utilisateur->getPhoto());
        $statement->bindValue(':modules', $utilisateur->getModules());
        $statement->bindValue(':id', $utilisateur->getId());

        return $statement->execute();
    }
    /**
     * Undocumented function
     *
     * @param integer $id
     * @return Utilisateur|null
     */
    public static function getById(int $id): ?Utilisateur
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM utilisateur WHERE id = :id");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);

        return $statement->fetch();
    }

    public static function getAll()
    {
        $pdo = Connector::getPDO();
        $query = $pdo->query("SELECT * FROM utilisateur");

        return $query->fetchAll(PDO::FETCH_CLASS, Utilisateur::class);
    }

    public static function getAllFilter(?string $criteres)
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM utilisateur WHERE nom LIKE %:critere% OR
            prenom LIKE %:critere% OR pseudo LIKE %:critere% OR poste LIKE %:critere% OR etat
            LIKE %:critere% OR modules LIKE %:critere%");
        $statement->bindValue(':critere', $criteres);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Utilisateur::class);
    }

    /**
     * Undocumented function
     *
     * @param integer|null $id
     * @return boolean|null
     */
    public static function deleteUser(?int $id): ?bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("DELETE FROM utilisateur WHERE id = :id");
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    public static function totalLine(): int
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM utilisateur");
        $statement->execute();
        return (int) $statement->fetchColumn();
    }

    /**
     * Undocumented function
     *
     * @param string $pseudo
     * @return Utilisateur|null
     */
    public static function getByPseudo(string $pseudo): ?Utilisateur
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
        $statement->bindValue(':pseudo', $pseudo);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
        $utilisateur = $statement->fetch();
        if(!$utilisateur){
            return null;
        }

        return $utilisateur;
    }
}
