<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Genre
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Genre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_genre", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_genre", type="string", length=80)
     */
    private $nomGenre;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Chansons", mappedBy="genre")
     */
    private $chansons;


    public function __construct()
    {
        $this->chansons = new ArrayCollection();
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
     * Set nomGenre
     *
     * @param string $nomGenre
     * @return Genre
     */
    public function setNomGenre($nomGenre)
    {
        $this->nomGenre = $nomGenre;

        return $this;
    }

    /**
     * Get nomGenre
     *
     * @return string 
     */
    public function getNomGenre()
    {
        return $this->nomGenre;
    }

    /**
     * Add chansons
     *
     * @param \AppBundle\Entity\Chansons $chansons
     * @return Genre
     */
    public function addChanson(\AppBundle\Entity\Chansons $chansons)
    {
        $this->chansons[] = $chansons;

        return $this;
    }

    /**
     * Remove chansons
     *
     * @param \AppBundle\Entity\Chansons $chansons
     */
    public function removeChanson(\AppBundle\Entity\Chansons $chansons)
    {
        $this->chansons->removeElement($chansons);
    }

    /**
     * Get chansons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChansons()
    {
        return $this->chansons;
    }
}
