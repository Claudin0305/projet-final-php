<?php

namespace App\Model;

class Professeur
{
    use Personne;
  
    private $cours_a_enseigner;
   
    private $poste;
    
    private $statut;
    
    private $salaire;

    
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getCoursAEnseigner(): ?string
    {
        return $this->cours_a_enseigner;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getPoste(): ?string
    {
        return $this->poste;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getStatut(): ?string
    {
        return $this->statut;
    }
    /**
     * Undocumented function
     *
     * @return float|null
     */
    public function getSalaire(): ?float
    {
        return $this->salaire;
    }
    /**
     * Undocumented function
     *
     * @param string $cours
     * @return void
     */
    public function setCoursAEnseigner(string $cours)
    {
        $this->cours_a_enseigner = $cours;
    }
    /**
     * Undocumented function
     *
     * @param string $poste
     * @return void
     */
    public function setPoste(string $poste)
    {
        $this->poste = $poste;
    }
    /**
     * Undocumented function
     *
     * @param string $statut
     * @return void
     */
    public function setStatut(string $statut)
    {
        $this->statut = $statut;
    }
    /**
     * Undocumented function
     *
     * @param float $salaire
     * @return void
     */
    public function setSalaire(float $salaire)
    {
        $this->salaire = $salaire;
    }
}
