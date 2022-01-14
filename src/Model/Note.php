<?php

namespace App\Model;

class Note
{
    /**
     * Undocumented variable
     *
     * @var integer
     */
    private $id;
    /**
     * Undocumented variable
     *
     * @var string
     */
    private
        $session,
        $id_etudiant,
        $id_cours,
        $id_annee_academique;
    /**
     * Undocumented variable
     *
     * @var float
     */
    private $note;
   
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
    public function getSession(): ?string
    {
        return $this->session;
    }
    
    /**
     * Undocumented function
     *
     * @return integer|null
     */
    public function getIdCours(): ?int
    {
        return $this->id_cours;
    }
   
    /**
     * Undocumented function
     *
     * @return integer|null
     */
    public function getIdAnne(): ?int
    {
        return $this->id_annee_academique;
    }

    /**
     * Undocumented function
     *
     * @return float|null
     */
    public function getNote(): ?float
    {
        return $this->note;
    }
    /**
     * Undocumented function
     *
     * @param integer|null $id
     * @return void
     */
    public function setId(?int $id)
    {
        $this->id = $id;
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
    
    public function setIdCours(?int $id_cours)
    {
        $this->id_cours = $id_cours;
    }
    /**
     * Undocumented function
     *
     * @param string|null $annee_academique
     * @return void
     */
    public function setAnneeAcademique(?int $id_annee_academique)
    {
        $this->id_annee_academique = $id_annee_academique;
    }
    
    /**
     * Undocumented function
     *
     * @return integer|null
     */
    public function getIdEtudiant(): ?int
    {
        return $this->id_etudiant;
    }
  
    /**
     * Undocumented function
     *
     * @param integer|null $id_etudiant
     * @return void
     */
    public function setIdEtudiant(?int $id_etudiant)
    {
        $this->id_etudiant = $id_etudiant;
    }

    /**
     * Undocumented function
     *
     * @param float|null $note
     * @return void
     */
    public function setNote(?float $note)
    {
        $this->note = $note;
    }
}
