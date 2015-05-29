<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Artiste
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Artiste
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_artiste", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_artiste", type="string", length=120)
     */
    private $nomArtiste;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Album", mappedBy="artiste")
     */
    private $albums;
    
    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Chansons", mappedBy="artiste")
     */
    private $chansons;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
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
     * Set nomArtiste
     *
     * @param string $nomArtiste
     * @return Artiste
     */
    public function setNomArtiste($nomArtiste)
    {
        $this->nomArtiste = $nomArtiste;

        return $this;
    }

    /**
     * Get nomArtiste
     *
     * @return string 
     */
    public function getNomArtiste()
    {
        return $this->nomArtiste;
    }

    /**
     * Add albums
     *
     * @param \AppBundle\Entity\Album $albums
     * @return Artiste
     */
    public function addAlbum(\AppBundle\Entity\Album $albums)
    {
        $this->albums[] = $albums;

        return $this;
    }

    /**
     * Remove albums
     *
     * @param \AppBundle\Entity\Album $albums
     */
    public function removeAlbum(\AppBundle\Entity\Album $albums)
    {
        $this->albums->removeElement($albums);
    }

    /**
     * Get albums
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAlbums()
    {
        return $this->albums;
    }

    /**
     * Add chansons
     *
     * @param \AppBundle\Entity\Chansons $chansons
     * @return Artiste
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
