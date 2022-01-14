<?php

namespace App\Model;

class Utilisateur
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
    private $nom,
        $prenom,
        $poste,
        $pseudo,
        $passWord,
        $etat,
        $photo,
        $modules;

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
     * @param string|null $pseudo
     * @return void
     */
    public function setPseudo(?string $pseudo){
        $this->pseudo = $pseudo;
    }
    /**
     * Undocumented function
     *
     * @param string|null $prenom
     * @return void
     */
    public function setPrenom(?string $prenom)
    {
        $this->prenom = $prenom;
    }
    /**
     * Undocumented function
     *
     * @param string|null $poste
     * @return void
     */
    public function setPoste(?string $poste = null)
    {
        $this->poste = $poste;
    }
    /**
     * Undocumented function
     *
     * @param string|null $photo
     * @return void
     */
    public function setPhoto(?string $photo = null)
    {
        $this->photo = $photo;
    }
    /**
     * Undocumented function
     *
     * @param string|null $modules
     * @return void
     */
    public function setModules(?string $modules)
    {
        $this->modules = $modules;
    }
    /**
     * Undocumented function
     *
     * @param string|null $passWord
     * @return void
     */
    public function setPassword(?string $passWord)
    {
        $this->passWord = $passWord;
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
    public function getPoste(): ?string
    {
        return $this->poste;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getPassWord(): ?string
    {
        return $this->passWord;
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
    public function getPhoto(): ?string
    {
        return $this->photo;
    }
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getModules(): ?string
    {
        return $this->modules;
    }
}
