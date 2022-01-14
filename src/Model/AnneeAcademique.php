<?php

namespace App\Model;

use \DateTime;

class AnneeAcademique
{
    private $id;
    private $annee_debut;
    private $annee_fin;
    private $date_debut;
    private $date_fin;
    private $etat;
    private $annee_academique;

    /*
     * Undocumented function
     *
     * @param integer|null $annee_debut
     * @param integer|null $annee_fin
     * @param string|null $date_debut
     * @param string|null $date_fin
     * @param string|null $etat
     
    public function __construct(
        ?int $annee_debut = null,
        ?int $annee_fin = null,
        ?string $date_debut = null,
        ?string $date_fin = null,
        ?string $etat = null
    ) {
        $this->annee_debut = $annee_debut;
        $this->annee_fin = $annee_fin;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->etat = $etat;
        $this->annee_academique = "$annee_debut-$annee_fin";
    }
*/
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
     * @return integer|null
     */
    public function getAnneeDebut(): ?int
    {
        return $this->annee_debut;
    }
    /**
     * Undocumented function
     *
     * @return integer|null
     */
    public function getAnneeFin(): ?int
    {
        return $this->annee_fin;
    }

    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getDateDebut(): ?string
    {
        return $this->date_debut;
    }

    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getDateFin(): ?string
    {
        return $this->date_fin;
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
    public function getAnneeAcademique(): ?string
    {
        return $this->annee_academique;
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
     * @param integer|null $annee_debut
     * @return void
     */
    public function setAnneeDebut(?int $annee_debut)
    {
        $this->annee_debut = $annee_debut;
    }
    /**
     * Undocumented function
     *
     * @param integer|null $annee_fin
     * @return void
     */
    public function setAnneeFin(?int $annee_fin)
    {
        $this->annee_fin = $annee_fin;
    }

    /**
     * Undocumented function
     *
     * @param string|null $date_debut
     * @return void
     */
    public function setDateDebut(?string $date_debut)
    {
        $this->date_debut = $date_debut;
    }

    /**
     * Undocumented function
     *
     * @param string|null $date_fin
     * @return void
     */
    public function setDateFin(?string $date_fin)
    {
        $this->date_fin = $date_fin;
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
     * @param string|null $annee_academique
     * @return void
     */
    public function setAnneeAcademique(?string $annee_academique)
    {
        $this->annee_academique = $annee_academique;
    }
}
