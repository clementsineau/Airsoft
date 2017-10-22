<?php

namespace Airsoft\GestionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
//use Gedmo\Mapping\Annotation as Gedmo;
//use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Club
 */
class Club
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Assert\Length(min=5, max=30, minMessage="Le nom du Club doit faire au moins {{ limit }} caractères.")
     */
    private $nomClub;

    /**
     * @var string
     * @Assert\Length(min=2, max=50, minMessage="L'adresse doit faire au moins {{ limit }} caractères.")
     */
    private $adresseClub;

    /**
     * @var string
     * @Assert\Length(min=2, max=50, minMessage="La ville doit faire au moins {{ limit }} caractères.")
     */
    private $villeClub;

    /**
     * @var integer
     * @Assert\Length(min=5, max=5, minMessage="Le code postal doit faire au moins {{ limit }} caractères.")
     */
    private $cpClub;

    /**
     * @var string
     * @Assert\Length(min=5, max=50, minMessage="L'email doit faire au moins {{ limit }} caractères.")
     */
    private $emailClub;

    /**
     * @var string
     * @Assert\Length(max =14,min=10, minMessage="Le téléphone doit faire au moins {{ limit }} caractères.")
     *
     */
    private $telClub;

    /**
     * @var \ DateTime
     * @Assert\Date()
     */
    private $dateClub;

    /**
     * @var bool
     */
    private  $published=true;

    private $membres;// Ici membres prend un "s", car un club a plusieurs membres !

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $listAdherents;

    /**
     * @var \Airsoft\GestionBundle\Entity\President
     */
    private $president;

    /**
     * @var \Airsoft\GestionBundle\Entity\Tresorier
     */
    private $tresorier;

    private $updatedAt;

//    /**
//     * @ORM\OneToOne(targetEntity="Airsoft\GestionBundle\Entity\Image", cascade={"persist", "remove"})
//     */
    private $image;

    // Comme la propriété $membres doit être un ArrayCollection,
    // On doit la définir dans un constructeur :
    public function __construct()
    {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->dateClub = new \Datetime();
        $this->updatedAt = new \Datetime();
        $this->membres = new ArrayCollection();
        $this->listAdherents = new ArrayCollection();
    }

    /**
     * @param Image $image
     * @return Club
     */
    public function setImage(\Airsoft\GestionBundle\Entity\Image $image = null)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }

    // Notez le singulier, on ajoute un seul membre à la fois
    public function addMembre(Membre $membre)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->membres[] = $membre;
        return $this;
    }

    public function removeMembre(Membre $membre)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->membres->removeElement($membre);
    }

    // Notez le pluriel, on récupère une liste de catégories ici !
    public function getMembres()
    {
        return $this->membres;
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
     * Set nomClub
     *
     * @param string $nomClub
     *
     * @return Club
     */
    public function setNomClub($nomClub)
    {
        $this->nomClub = $nomClub;

        return $this;
    }

    /**
     * Get nomClub
     *
     * @return string
     */
    public function getNomClub()
    {
        return $this->nomClub;
    }

    /**
     * Set adresseClub
     *
     * @param string $adresseClub
     *
     * @return Club
     */
    public function setAdresseClub($adresseClub)
    {
        $this->adresseClub = $adresseClub;

        return $this;
    }

    /**
     * Get adresseClub
     *
     * @return string
     */
    public function getAdresseClub()
    {
        return $this->adresseClub;
    }

    /**
     * Set villeClub
     *
     * @param string $villeClub
     *
     * @return Club
     */
    public function setVilleClub($villeClub)
    {
        $this->villeClub = $villeClub;

        return $this;
    }

    /**
     * Get villeClub
     *
     * @return string
     */
    public function getVilleClub()
    {
        return $this->villeClub;
    }

    /**
     * Set cpClub
     *
     * @param integer $cpClub
     *
     * @return Club
     */
    public function setCpClub($cpClub)
    {
        $this->cpClub = $cpClub;

        return $this;
    }

    /**
     * Get cpClub
     *
     * @return integer
     */
    public function getCpClub()
    {
        return $this->cpClub;
    }

    /**
     * Set emailClub
     *
     * @param string $emailClub
     *
     * @return Club
     */
    public function setEmailClub($emailClub)
    {
        $this->emailClub = $emailClub;

        return $this;
    }

    /**
     * Get emailClub
     *
     * @return string
     */
    public function getEmailClub()
    {
        return $this->emailClub;
    }

    /**
     * Set telClub
     *
     * @param string $telClub
     *
     * @return Club
     */
    public function setTelClub($telClub)
    {
        $this->telClub = $telClub;

        return $this;
    }

    /**
     * Get telClub
     *
     * @return string
     */
    public function getTelClub()
    {
        return $this->telClub;
    }

    /**
 * Set dateClub
 *
 * @param \DateTime $dateClub
 *
 * @return Club
 */
    public function setDateClub($dateClub)
    {
        $this->dateClub = $dateClub;

        return $this;
    }

    /**
     * Get dateClub
     *
     * @return \DateTime
     */
    public function getDateClub()
    {
        return $this->dateClub;
    }


    public function setPublished($published)
    {
        $this->published = $published;
        return $this;
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


    /**
     * Set president
     *
     * @param \Airsoft\GestionBundle\Entity\President $president
     *
     * @return Club
     */
    public function setPresident(\Airsoft\GestionBundle\Entity\President $president = null)
    {
        $this->president = $president;

        return $this;
    }

    /**
     * Get president
     *
     * @return \Airsoft\GestionBundle\Entity\President
     */
    public function getPresident()
    {
        return $this->president;
    }

    /**
     * Set tresorier
     *
     * @param \Airsoft\GestionBundle\Entity\Tresorier $tresorier
     *
     * @return Club
     */
    public function setTresorier(\Airsoft\GestionBundle\Entity\Tresorier $tresorier = null)
    {
        $this->tresorier = $tresorier;

        return $this;
    }

    /**
     * Get tresorier
     *
     * @return \Airsoft\GestionBundle\Entity\Tresorier
     */
    public function getTresorier()
    {
        return $this->tresorier;
    }

    /**
     * Add Adherent
     *
     * @param \Airsoft\GestionBundle\Entity\Adherent $adherent
     *
     * @return Adherent
     */

    // Notez le singulier, on ajoute un seul membre à la fois
    public function addAdherent(\Airsoft\GestionBundle\Entity\Adherent $adherent)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->listAdherents[] = $adherent;
        return $this;
    }

    public function removeAdherent(Adherent $adherent)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->listAdherents->removeElement($adherent);
    }

    // Notez le pluriel, on récupère une liste de adhérents ici !
    public function getAdherents()
    {
        return $this->listAdherents;
    }

    /**
     * Add listAdherent
     *
     * @param \Airsoft\GestionBundle\Entity\Adherent $listAdherent
     *
     * @return Club
     */
    public function addListAdherent(\Airsoft\GestionBundle\Entity\Adherent $listAdherent)
    {
        $this->listAdherents[] = $listAdherent;

        return $this;
    }

    /**
     * Remove listAdherent
     *
     * @param \Airsoft\GestionBundle\Entity\Adherent $listAdherent
     */
    public function removeListAdherent(\Airsoft\GestionBundle\Entity\Adherent $listAdherent)
    {
        $this->listAdherents->removeElement($listAdherent);
    }

    /**
     * Get listAdherents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListAdherents()
    {
        return $this->listAdherents;
    }

    /**
     * @ORM\PreUpdate
     * Callback pour mettre à jour la date d'édition à chaque modification de l'entité
     */
    public function updateDate()
    {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setUpdatedAt(\Datetime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getNomClub();
    }
}
