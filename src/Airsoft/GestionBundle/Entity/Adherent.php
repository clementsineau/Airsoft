<?php

namespace Airsoft\GestionBundle\Entity;

/**
 * Adherent
 */
class Adherent
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateLicence;

    /**
     * @var Club
     */
    private $club;

    /**
     * @var Membre
     */
    private $membre;

    public function __construct()
    {
        $this->dateLicence = new \DateTime();
    }

    /**
     * @return Club
     */
    public function getClubs()
    {
        return $this->club;
    }

    /**
     * @param Club $club
     */
    public function setClubs($club)
    {
        $this->club = $club;
    }

    /**
     * Set membre
     *
     * @param \Airsoft\GestionBundle\Entity\Membre $membre
     *
     * @return Adherent
     */
    public function setMembre(\Airsoft\GestionBundle\Entity\Membre $membre = null)
    {
        $this->membre = $membre;

        return $this;
    }

    /**
     * Get membre
     *
     * @return \Airsoft\GestionBundle\Entity\Membre
     */
    public function getMembre()
    {
        return $this->membre;
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
     * Set dateLicence
     *
     * @param \DateTime $dateLicence
     *
     * @return Adherent
     */
    public function setDateLicence($dateLicence)
    {
        $this->dateLicence = $dateLicence;

        return $this;
    }

    /**
     * Get dateLicence
     *
     * @return \DateTime
     */
    public function getDateLicence()
    {
        return $this->dateLicence;
    }

    /**
     * Set club
     *
     * @param \Airsoft\GestionBundle\Entity\Club $club
     *
     * @return Adherent
     */
    public function setClub(\Airsoft\GestionBundle\Entity\Club $club = null)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return \Airsoft\GestionBundle\Entity\Club
     */
    public function getClub()
    {
        return $this->club;
    }


}
