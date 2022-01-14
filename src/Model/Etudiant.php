<?php

namespace App\Model;

class Etudiant
{
    use Personne;
    
    private $personne_de_reference;
    
    private $tel_personne_de_ref;
    
    private $id_annee_academique;

    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getPersonneDeReference(): ?string
    {
        return $this->personne_de_reference;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getTelPersonneDeRef(): ?string
    {
        return $this->tel_personne_de_ref;
    }
    /**
     * Undocumented function
     *
     * @return integer|null
     */
    public function getIdAnneeAcademique(): ?int
    {
        return $this->id_annee_academique;
    }
    /**
     * Undocumented function
     *
     * @param string|null $personne_de_reference
     * @return void
     */
    public function setPersonneDeReference(?string $personne_de_reference)
    {
        $this->personne_de_reference = $personne_de_reference;
    }
    /**
     * Undocumented function
     *
     * @param string|null $tel_personne_de_ref
     * @return void
     */
    public function setTelPersonneDeRef(?string $tel_personne_de_ref)
    {
        $this->tel_personne_de_ref = $tel_personne_de_ref;
    }
    /**
     * Undocumented function
     *
     * @param integer|null $id_annee_academique
     * @return void
     */
    public function setIdAnneeAcademique(?int $id_annee_academique)
    {
        $this->id_annee_academique = $id_annee_academique;
    }
}
