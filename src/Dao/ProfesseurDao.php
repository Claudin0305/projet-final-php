<?php

namespace App\Dao;

use App\Connector;
use App\Model\Professeur;
use PDO;

class ProfesseurDao
{
    /**
     * Undocumented function
     *
     * @param Professeur $professeur
     * @return boolean
     */
    public static function insertProfesseur(Professeur $professeur): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("INSERT INTO professeur(code,
        prenom,
        nom,
        sexe,
        adresse,
        lieu_de_naissance,
        telephone,
        date_de_naissance,
        email,
        niveau,
        filiere,
        memo,
        etat,
        nif_or_cin,
        photo,
        cours_a_enseigner,
        poste,
        statut,
        salaire) VALUES(:code,
        :prenom,
        :nom,
        :sexe,
        :adresse,
        :lieu_de_naissance,
        :telephone,
        :date_de_naissance,
        :email,
        :niveau,
        :filiere,
        :memo,
        :etat,
        :nif_or_cin,
        :photo,
        :cours_a_enseigner,
        :poste,
        :statut,
        :salaire
        )");
        $statement->bindValue(':code', $professeur->getCode());
        $statement->bindValue(':prenom', $professeur->getPrenom());
        $statement->bindValue(':nom', $professeur->getNom());
        $statement->bindValue(':sexe', $professeur->getSexe());
        $statement->bindValue(':adresse', $professeur->getAdresse());
        $statement->bindValue(':lieu_de_naissance', $professeur->getLieuDeNaissance());
        $statement->bindValue(':telephone', $professeur->getTelephone());
        $statement->bindValue(':date_de_naissance', $professeur->getDateDenaissance());
        $statement->bindValue(':email', $professeur->getEmail());
        $statement->bindValue(':niveau', $professeur->getNiveau());
        $statement->bindValue(':filiere', $professeur->getFiliere());
        $statement->bindValue(':memo', $professeur->getMemo());
        $statement->bindValue(':etat', $professeur->getEtat());
        $statement->bindValue(':nif_or_cin', $professeur->getNifOrCin());
        $statement->bindValue(':photo', $professeur->getPhoto());
        $statement->bindValue(':cours_a_enseigner', $professeur->getCoursAEnseigner());
        $statement->bindValue(':poste', $professeur->getPoste());
        $statement->bindValue(':statut', $professeur->getStatut());
        $statement->bindValue(':salaire', $professeur->getSalaire());

        return $statement->execute();
    }

    public static function updateProfesseur(Professeur $professeur):bool{
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("UPDATE professeur SET code=:code,
        prenom = :prenom,
        nom = :nom,
        sexe = :sexe,
        adresse = :adresse,
        lieu_de_naissance = :lieu_de_naissance,
        telephone = :telephone,
        date_de_naissance = :date_de_naissance,
        email = :email,
        niveau = :niveau,
        filiere = :filiere,
        memo = :memo,
        etat = :etat,
        nif_or_cin = :nif_or_cin,
        photo = :photo,
        cours_a_enseigner = :cours_a_enseigner,
        poste = :poste,
        statut = :statut,
        salaire = :salaire WHERE id = :id");
        $statement->bindValue(':code', $professeur->getCode());
        $statement->bindValue(':prenom', $professeur->getPrenom());
        $statement->bindValue(':nom', $professeur->getNom());
        $statement->bindValue(':sexe', $professeur->getSexe());
        $statement->bindValue(':adresse', $professeur->getAdresse());
        $statement->bindValue(':lieu_de_naissance', $professeur->getLieuDeNaissance());
        $statement->bindValue(':telephone', $professeur->getTelephone());
        $statement->bindValue(':date_de_naissance', $professeur->getDateDenaissance());
        $statement->bindValue(':email', $professeur->getEmail());
        $statement->bindValue(':niveau', $professeur->getNiveau());
        $statement->bindValue(':filiere', $professeur->getFiliere());
        $statement->bindValue(':memo', $professeur->getMemo());
        $statement->bindValue(':etat', $professeur->getEtat());
        $statement->bindValue(':nif_or_cin', $professeur->getNifOrCin());
        $statement->bindValue(':photo', $professeur->getPhoto());
        $statement->bindValue(':cours_a_enseigner', $professeur->getCoursAEnseigner());
        $statement->bindValue(':poste', $professeur->getPoste());
        $statement->bindValue(':statut', $professeur->getStatut());
        $statement->bindValue(':salaire', $professeur->getSalaire());
        $statement->bindValue(':id', $professeur->getId());

        return $statement->execute();
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return Utilisateur|null
     */
    public static function getById(int $id): ?Professeur
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM professeur WHERE id = :id");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Professeur::class);

        return $statement->fetch();
    }

    public static function getAll()
    {
        $pdo = Connector::getPDO();
        $query = $pdo->query("SELECT * FROM professeur");

        return $query->fetchAll(PDO::FETCH_CLASS, Professeur::class);
    }

    public static function getAllFilter(?string $criteres)
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM professeur WHERE nom LIKE %:critere% OR
            prenom LIKE %:critere% OR niveau LIKE %:critere% OR filiere LIKE %:critere% OR etat
            LIKE %:critere% OR code LIKE %:critere%");
        $statement->bindValue(':critere', $criteres);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Professeur::class);
    }

    /**
     * Undocumented function
     *
     * @param integer|null $id
     * @return boolean|null
     */
    public static function deleteProfesseur(?int $id): ?bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("DELETE FROM professeur WHERE id = :id");
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    public static function totalLine(): int
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM professeur");
        $statement->execute();
        return (int) $statement->fetchColumn();
    }
}
