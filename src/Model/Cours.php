<?php

namespace App\Model;

class Cours
{

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $id,
        $coefficient,
        $prof_id,
        $prof_sup_id;

    private $code,
        $nom,
        $filiere,
        $niveau,
        $session,
        $jours,
        $heure_debut,
        $heure_fin,
        $etat;

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
    public function getCode(): ?string
    {
        return $this->code;
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
    public function getFiliere(): ?string
    {
        return $this->filiere;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getSession(): ?string
    {
        return $this->session;
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
     * @return integer|null
     */
    public function getProfId(): ?int
    {
        return $this->prof_id;
    }

    /**
     * Undocumented function
     *
     * @return integer|null
     */
    public function getProfSupId(): ?int
    {
        return $this->prof_sup_id;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getJours(): ?string
    {
        return $this->jours;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getHeureDebut(): ?string
    {
        return $this->heure_debut;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getHeureFin(): ?string
    {
        return $this->heure_fin;
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
     * @return integer|null
     */
    public function getCoefficient(): ?int
    {
        return $this->coefficient;
    }
    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
    /**
     * Undocumented function
     *
     * @param string|null $code
     * @return void
     */
    public function setCode(?string $code)
    {
        $this->code = $code;
    }
    /**
     * Undocumented function
     *
     * @param string|null $nom
     * @return void
     */
    public function setNom(?string $nom)
    {
        $this->nom = $nom;
    }
    /**
     * Undocumented function
     *
     * @param string|null $filiere
     * @return void
     */
    public function setFiliere(?string $filiere)
    {
        $this->filiere = $filiere;
    }
    /**
     * Undocumented function
     *
     * @param string|null $session
     * @return void
     */
    public function setSession(?string $session)
    {
        $this->session = $session;
    }
    /**
     * Undocumented function
     *
     * @param string|null $niveau
     * @return void
     */
    public function setNiveau(?string $niveau)
    {
        $this->niveau = $niveau;
    }

    /**
     * Undocumented function
     *
     * @param integer|null $prof
     * @return void
     */
    public function setProfId(?int $prof)
    {
        $this->prof_id = $prof;
    }

    /**
     * Undocumented function
     *
     * @param integer|null $prof
     * @return void
     */
    public function setProfSupId(?int $prof)
    {
        $this->prof_sup_id = $prof;
    }
    /**
     * Undocumented function
     *
     * @param string|null $jours
     * @return void
     */
    public function setJours(?string $jours)
    {
        $this->jours = $jours;
    }
    /**
     * Undocumented function
     *
     * @param string|null $heure_debut
     * @return void
     */
    public function setHeureDebut(?string $heure_debut)
    {
        $this->heure_debut = $heure_debut;
    }
    /**
     * Undocumented function
     *
     * @param string|null $heure_fin
     * @return void
     */
    public function setHeureFin(?string $heure_fin)
    {
        $this->heure_fin = $heure_fin;
    }
    /**
     * Undocumented function
     *
     * @param string|null $etat
     * @return void
     */
    public function setEtat(?string $etat)
    {
        $this->etat = $etat;
    }
    /**
     * Undocumented function
     *
     * @param integer|null $coefficient
     * @return void
     */
    public function setCoefficient(?int $coefficient)
    {
        $this->coefficient = $coefficient;
    }
}
