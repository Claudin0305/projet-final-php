<?php

namespace App\Model;


trait Personne
{

    private $id;

    private $photo;

    private $code;

    private $prenom;

    private $nom;

    private $sexe;

    private $adresse;

    private $lieu_de_naissance;

    private $telephone;

    private $date_de_naissance;

    private $email;

    private $niveau;

    private $filiere;

    private $memo;

    private $etat;

    private $nif_or_cin;
    /**
     * Undocumented function
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getSexe(): ?string
    {
        return $this->sexe;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getLieuDeNaissance(): ?string
    {
        return $this->lieu_de_naissance;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getDateDeNaissance(): ?string
    {
        return $this->date_de_naissance;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getNiveau(): ?string
    {
        return $this->niveau;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getFiliere(): ?string
    {
        return $this->filiere;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getMemo(): ?string
    {
        return $this->memo;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getEtat(): ?string
    {
        return $this->etat;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getNifOrCin(): ?string
    {
        return $this->nif_or_cin;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }
    /**
     * Undocumented function
     *
     * @param integer|null $id
     * @return void
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
    /**
     * Undocumented function
     *
     * @param string|null $photo
     * @return void
     */
    public function setPhoto(string $photo)
    {
        $this->photo = $photo;
    }
    /**
     * Undocumented function
     *
     * @param string|null $code
     * @return void
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }
    /**
     * Undocumented function
     *
     * @param string|null $nom
     * @return void
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }
    /**
     * Undocumented function
     *
     * @param string|null $prenom
     * @return void
     */
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }
    /**
     * Undocumented function
     *
     * @param string|null $sexe
     * @return void
     */
    public function setSexe(string $sexe)
    {
        $this->sexe = $sexe;
    }
    /**
     * Undocumented function
     *
     * @param string|null $adresse
     * @return void
     */
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;
    }
    /**
     * Undocumented function
     *
     * @param string|null $lieu_de_naissance
     * @return void
     */
    public function setLieuDeNaissance(string $lieu_de_naissance)
    {
        $this->lieu_de_naissance = $lieu_de_naissance;
    }
    /**
     * Undocumented function
     *
     * @param string|null $telephone
     * @return void
     */
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
    }
    /**
     * Undocumented function
     *
     * @param string $date_de_naissance
     * @return void
     */
    public function setDateDenaissance(string $date_de_naissance)
    {
        $this->date_de_naissance = $date_de_naissance;
    }
    /**
     * Undocumented function
     *
     * @param string|null $email
     * @return void
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    /**
     * Undocumented function
     *
     * @param string|null $niveau
     * @return void
     */
    public function setNiveau(string $niveau)
    {
        $this->niveau = $niveau;
    }
    /**
     * Undocumented function
     *
     * @param string|null $filiere
     * @return void
     */
    public function setFiliere(string $filiere)
    {
        $this->filiere = $filiere;
    }
    /**
     * Undocumented function
     *
     * @param string|null $memo
     * @return void
     */
    public function setMemo(string $memo)
    {
        $this->memo = $memo;
    }
    /**
     * Undocumented function
     *
     * @param string|null $etat
     * @return void
     */
    public function setEtat(string $etat)
    {
        $this->etat = $etat;
    }
    /**
     * Undocumented function
     *
     * @param string|null $nif_or_cin
     * @return void
     */
    public function setNifiOrCin(string $nif_or_cin)
    {
        $this->nif_or_cin = $nif_or_cin;
    }
}
