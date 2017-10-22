<?php

namespace Airsoft\GestionBundle\Entity;

/**
 * Membre
 */
use Doctrine\Common\Collections\ArrayCollection;

//use Doctrine\ORM\Mapping as ORM;
class Membre
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nomMembre;

    /**
     * @var string
     */
    private $prenomMembre;

    /**
     * @var string
     */
    private $adresseMembre;

    /**
     * @var string
     */
    private $villeMembre;

    /**
     * @var integer
     */
    private $cpMembre;

    /**
     * @var string
     */
    private $emailMembre;

    /**
     * @var string
     */
    private $telMembre;

    /**
     * @var \DateTime
     */
    private $dateMembre;

    private $sexe;
    private $clubs;

    private $published = true;

    private $listAdherents;

    private $tresorier;

    private $president;

    public function __construct()
    {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->dateMembre = new \Datetime();
        $this->clubs = new ArrayCollection();
        $this->listAdherents = new ArrayCollection();
    }
    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get nomMembre
     *
     * @return string
     */
    public function getNomMembre()
    {
        return $this->nomMembre;
    }

    /**
     * Set nomMembre
     *
     * @param string $nomMembre
     *
     * @return Membre
     */
    public function setNomMembre($nomMembre)
    {
        $this->nomMembre = $nomMembre;

        return $this;
    }

    /**
     * Get prenomMembre
     *
     * @return string
     */
    public function getPrenomMembre()
    {
        return $this->prenomMembre;
    }

    /**
     * Set prenomMembre
     *
     * @param string $prenomMembre
     *
     * @return Membre
     */
    public function setPrenomMembre($prenomMembre)
    {
        $this->prenomMembre = $prenomMembre;

        return $this;
    }

    /**
     * Get adresseMembre
     *
     * @return string
     */
    public function getAdresseMembre()
    {
        return $this->adresseMembre;
    }

    /**
     * Set adresseMembre
     *
     * @param string $adresseMembre
     *
     * @return Membre
     */
    public function setAdresseMembre($adresseMembre)
    {
        $this->adresseMembre = $adresseMembre;

        return $this;
    }

    /**
     * Get villeMembre
     *
     * @return string
     */
    public function getVilleMembre()
    {
        return $this->villeMembre;
    }

    /**
     * Set villeMembre
     *
     * @param string $villeMembre
     *
     * @return Membre
     */
    public function setVilleMembre($villeMembre)
    {
        $this->villeMembre = $villeMembre;

        return $this;
    }

    /**
     * Get cpMembre
     *
     * @return integer
     */
    public function getCpMembre()
    {
        return $this->cpMembre;
    }

    /**
     * Set cpMembre
     *
     * @param integer $cpMembre
     *
     * @return Membre
     */
    public function setCpMembre($cpMembre)
    {
        $this->cpMembre = $cpMembre;

        return $this;
    }

    /**
     * Get emailMembre
     *
     * @return string
     */
    public function getEmailMembre()
    {
        return $this->emailMembre;
    }

    /**
     * Set emailMembre
     *
     * @param string $emailMembre
     *
     * @return Membre
     */
    public function setEmailMembre($emailMembre)
    {
        $this->emailMembre = $emailMembre;

        return $this;
    }

    /**
     * Get telMembre
     *
     * @return string
     */
    public function getTelMembre()
    {
        return $this->telMembre;
    }

    /**
     * Set telMembre
     *
     * @param string $telMembre
     *
     * @return Membre
     */
    public function setTelMembre($telMembre)
    {
        $this->telMembre = $telMembre;

        return $this;
    }

    /**
     * Get dateMembre
     *
     * @return \DateTime
     */
    public function getDateMembre()
    {
        return $this->dateMembre;
    }

    /**
     * Set dateMembre
     *
     * @param \DateTime $dateMembre
     *
     * @return Membre
     */
    public function setDateMembre($dateMembre)
    {
        $this->dateMembre = $dateMembre;

        return $this;
    }

    /**
     * Add club
     *
     * @param \Airsoft\GestionBundle\Entity\Membre $club
     *
     * @return Membre
     */
    public function addClub(\Airsoft\GestionBundle\Entity\Membre $club)
    {
        $this->clubs[] = $club;

        return $this;
    }

    /**
     * Remove club
     *
     *\Airsoft\GestionBundle\Entity\Membre $club
     */
    public function removeClub(\Airsoft\GestionBundle\Entity\Membre $club)
    {
        $this->clubs->removeElement($club);
    }

    /**
     * Get clubs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClubs()
    {
        return $this->clubs;
    }

    /**
     * Add Adherent
     *
     * @param \Airsoft\GestionBundle\Entity\Adherent $adherent
     *
     * @return Membre
     */
    public function addAdherent(\Airsoft\GestionBundle\Entity\Adherent $adherent)
    {
        $this->listAdherents[]=$adherent;
        return $this;
    }

    /**
     * Remove Adherent
     *
     *\Airsoft\GestionBundle\Entity\Membre $adherent
     */
    public function removeAdherent(\Airsoft\GestionBundle\Entity\Adherent $adherent)
    {
        $this->listAdherents->removeElement($adherent);
    }

    /**
     * Get Adherents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdherents()
    {
        return $this->listAdherents;
    }

    /**
     * Get dateClub
     *
     * @return \Boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    // Notez le singulier, on ajoute une seule catégorie à la fois

    public function setPublished($published)
    {
        $this->published = $published;
        return $this;
    }

    /**
     * Add tresorier
     *
     * @param \Airsoft\GestionBundle\Entity\Tresorier $tresorier
     *
     * @return Membre
     */

    /**
     * Get tresorier
     * @return Tresorier
     */
    public function getTresorier()
    {
        return $this->tresorier;
    }

    /**
     * Set tresorier
     * @return Membre
     */
    public function setTresorier($tresorier)
    {
        $this->tresorier = $tresorier;
        return $this;
    }


    /**
     * Add president
     *
     * @param \Airsoft\GestionBundle\Entity\President $president
     *
     * @return Membre
     */

    /**
     * Get president
     * @return President
     */
    public function getPresident()
    {
        return $this->president;
    }
    /**
     * Set president
     * @return Membre
     */
    public function setPresident($president)
    {
//        dump($president); die();
        $this->president = $president;
        return $this;
    }


//    public function __toString()
//    {
//        // TODO: Implement __toString() method.
//        return $this->getAdherent();
//    }

}
