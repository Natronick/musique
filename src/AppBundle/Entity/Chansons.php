<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chansons
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Chansons
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_chanson", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_chanson", type="string", length=150)
     */
    private $nomChanson;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree_chanson", type="integer")
     */
    private $dureeChanson;
    
    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Artiste", inversedBy="chansons")
     * @ORM\JoinColumn(name="id_artiste", referencedColumnName="id_artiste")
     */
    private $artiste;
    
    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Album", inversedBy="chansons")
     * @ORM\JoinColumn(name="id_album", referencedColumnName="id_album")
     */
    private $album;
    
    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Genre", inversedBy="chansons")
     * @ORM\JoinColumn(name="id_genre", referencedColumnName="id_genre")
     */
    private $genre;


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
     * Set nomChanson
     *
     * @param string $nomChanson
     * @return Chansons
     */
    public function setNomChanson($nomChanson)
    {
        $this->nomChanson = $nomChanson;

        return $this;
    }

    /**
     * Get nomChanson
     *
     * @return string 
     */
    public function getNomChanson()
    {
        return $this->nomChanson;
    }

    /**
     * Set dureeChanson
     *
     * @param integer $dureeChanson
     * @return Chansons
     */
    public function setDureeChanson($dureeChanson)
    {
        $this->dureeChanson = $dureeChanson;

        return $this;
    }

    /**
     * Get dureeChanson
     *
     * @return integer 
     */
    public function getDureeChanson()
    {
        return $this->dureeChanson;
    }

    /**
     * Set artiste
     *
     * @param \AppBundle\Entity\Artiste $artiste
     * @return Chansons
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
     * Set album
     *
     * @param \AppBundle\Entity\Album $album
     * @return Chansons
     */
    public function setAlbum(\AppBundle\Entity\Album $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \AppBundle\Entity\Album 
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set genre
     *
     * @param \AppBundle\Entity\Genre $genre
     * @return Chansons
     */
    public function setGenre(\AppBundle\Entity\Genre $genre = null)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return \AppBundle\Entity\Genre 
     */
    public function getGenre()
    {
        return $this->genre;
    }
}
