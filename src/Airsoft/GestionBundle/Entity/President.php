<?php

namespace Airsoft\GestionBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * President
 */
class President
{
    /**
     * @var integer
     */
    private $id;

    private $club;

    /**
     * @var \Airsoft\GestionBundle\Entity\Membre
     */
    private $membre;
//
//    public function __construct()
//    {
//        $this->membre = new ArrayCollection();
//    }

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
     * Set membre
     *
     * @param \Airsoft\GestionBundle\Entity\Membre
     *
     * @return President
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
//    public function getMembres()
//    {
//        return $this->membre;
//    }

    /**
     * Set club
     *
     * @param \Airsoft\GestionBundle\Entity\Club $club
     *
     * @return President
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

    public function  __toString()
    {
        // TODO: Implement __toString() method.

        return $this->getClub()?$this->getClub()->getNomClub():'null';
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
}
