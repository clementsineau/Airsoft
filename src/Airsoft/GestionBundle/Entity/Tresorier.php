<?php

namespace Airsoft\GestionBundle\Entity;

/**
 * Tresorier
 */
class Tresorier
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

    /**
     * Get id
     *
     * @return integer     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set membre
     *
     * @param \Airsoft\GestionBundle\Entity\Membre $membre
     *
     * @return Tresorier
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
     * Set club
     *
     * @param \Airsoft\GestionBundle\Entity\Club $club
     *
     * @return Tresorier
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


    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getClub()->getNomClub();
    }
}
