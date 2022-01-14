<?php

namespace App\Dao;

use App\Connector;
use App\Model\Etudiant;
use PDO;

class EtudiantDao
{
    /**
     * Undocumented function
     *
     * @param Etudiant $etudiant
     * @return boolean
     */
    public static function insertEtudiant(Etudiant $etudiant): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("INSERT INTO etudiant(code,
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
        personne_de_reference,
        tel_personne_de_ref,
        id_annee_academique) VALUES(:code,
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
        :personne_de_reference,
        :tel_personne_de_ref,
        :id_annee_academique)");
        $statement->bindValue(':code', $etudiant->getCode());
        $statement->bindValue(':prenom', $etudiant->getPrenom());
        $statement->bindValue(':nom', $etudiant->getNom());
        $statement->bindValue(':sexe', $etudiant->getSexe());
        $statement->bindValue(':adresse', $etudiant->getAdresse());
        $statement->bindValue(':lieu_de_naissance', $etudiant->getLieuDeNaissance());
        $statement->bindValue(':telephone', $etudiant->getTelephone());
        $statement->bindValue(':date_de_naissance', $etudiant->getDateDenaissance());
        $statement->bindValue(':email', $etudiant->getEmail());
        $statement->bindValue(':niveau', $etudiant->getNiveau());
        $statement->bindValue(':filiere', $etudiant->getFiliere());
        $statement->bindValue(':memo', $etudiant->getMemo());
        $statement->bindValue(':etat', $etudiant->getEtat());
        $statement->bindValue(':nif_or_cin', $etudiant->getNifOrCin());
        $statement->bindValue(':photo', $etudiant->getPhoto());
        $statement->bindValue(':personne_de_reference', $etudiant->getPersonneDeReference());
        $statement->bindValue(':tel_personne_de_ref', $etudiant->getTelPersonneDeRef());
        $statement->bindValue(':id_annee_academique', $etudiant->getIdAnneeAcademique());

        return $statement->execute();
    }
    /**
     * Undocumented function
     *
     * @param Etudiant $etudiant
     * @return boolean
     */
    public static function updateEtudiant(Etudiant $etudiant): bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("UPDATE etudiant SET code=:code,
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
        personne_de_reference = :personne_de_reference,
        tel_personne_de_ref = :tel_personne_de_ref,
        id_annee_academique = :id_annee_academique WHERE id = :id");
        $statement->bindValue(':code', $etudiant->getCode());
        $statement->bindValue(':prenom', $etudiant->getPrenom());
        $statement->bindValue(':nom', $etudiant->getNom());
        $statement->bindValue(':sexe', $etudiant->getSexe());
        $statement->bindValue(':adresse', $etudiant->getAdresse());
        $statement->bindValue(':lieu_de_naissance', $etudiant->getLieuDeNaissance());
        $statement->bindValue(':telephone', $etudiant->getTelephone());
        $statement->bindValue(':date_de_naissance', $etudiant->getDateDenaissance());
        $statement->bindValue(':email', $etudiant->getEmail());
        $statement->bindValue(':niveau', $etudiant->getNiveau());
        $statement->bindValue(':filiere', $etudiant->getFiliere());
        $statement->bindValue(':memo', $etudiant->getMemo());
        $statement->bindValue(':etat', $etudiant->getEtat());
        $statement->bindValue(':nif_or_cin', $etudiant->getNifOrCin());
        $statement->bindValue(':photo', $etudiant->getPhoto());
        $statement->bindValue(':personne_de_reference', $etudiant->getPersonneDeReference());
        $statement->bindValue(':tel_personne_de_ref', $etudiant->getTelPersonneDeRef());
        $statement->bindValue(':id_annee_academique', $etudiant->getIdAnneeAcademique());
        $statement->bindValue(':id', $etudiant->getId());

        return $statement->execute();
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return Utilisateur|null
     */
    public static function getById(int $id): ?Etudiant
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM etudiant WHERE id = :id");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Etudiant::class);

        return $statement->fetch();
    }

    public static function getAll()
    {
        $pdo = Connector::getPDO();
        $query = $pdo->query("SELECT * FROM etudiant ");
        $etudiants = $query->fetchAll(PDO::FETCH_CLASS, Etudiant::class);
        return $etudiants;
    }

    public static function getAllFilter(?string $criteres)
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM etudiant WHERE nom LIKE %:critere% OR
            prenom LIKE %:critere% OR niveau LIKE %:critere% OR filiere LIKE %:critere% OR etat
            LIKE %:critere% OR code LIKE %:critere%");
        $statement->bindValue(':critere', $criteres);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Etudiant::class);
    }

    /**
     * Undocumented function
     *
     * @param integer|null $id
     * @return boolean|null
     */
    public static function deleteEtudiant(?int $id): ?bool
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("DELETE FROM etudiant WHERE id = :id");
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }
    public static function totalLine():int{
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM etudiant");
        $statement->execute();

        return (int) $statement->fetchColumn();
    }

    public static function totalLineById(int $id): int
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT COUNT(*) FROM etudiant WHERE id_annee_academique = :id AND etat='A' OR etat='a'");
        $statement->bindValue(':id', $id);
        $statement->execute();

        return (int) $statement->fetchColumn();
    }

    public static function getAllActif(int $id_year)
    {
        $pdo = Connector::getPDO();
        $statement = $pdo->prepare("SELECT * FROM etudiant WHERE id_annee_academique = :id AND etat='A'
        OR etat = 'a'");
        $statement->bindValue(':id', $id_year);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Etudiant::class);
    }
}
