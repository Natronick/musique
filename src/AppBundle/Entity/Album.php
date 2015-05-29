<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Album
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Album
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_album", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_album", type="string", length=150)
     */
    private $nomAlbum;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Artiste", inversedBy="albums")
     * @ORM\JoinColumn(name="id_artiste", referencedColumnName="id_artiste")
     */
    private $artiste;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Chansons", mappedBy="album")
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
     * Set nomAlbum
     *
     * @param string $nomAlbum
     * @return Album
     */
    public function setNomAlbum($nomAlbum)
    {
        $this->nomAlbum = $nomAlbum;

        return $this;
    }

    /**
     * Get nomAlbum
     *
     * @return string 
     */
    public function getNomAlbum()
    {
        return $this->nomAlbum;
    }

    /**
     * Set artiste
     *
     * @param \AppBundle\Entity\Artiste $artiste
     * @return Album
     */
    public function setArtiste(\AppBundle\Entity\Artiste $artiste = null)
    {
        $this->artiste = $artiste;

        return $this;
    }

    /**
     * Get artiste
     *
     * @return \AppBundle\Entity\Artiste 
     */
    public function getArtiste()
    {
        return $this->artiste;
    }

    /**
     * Add chansons
     *
     * @param \AppBundle\Entity\Chansons $chansons
     * @return Album
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
