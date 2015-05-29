<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Chansons;
use AppBundle\Entity\Album;
use AppBundle\Entity\Genre;
use AppBundle\Entity\Artiste;

class DefaultController extends Controller
{
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('attachment', 'file', array('label' => 'CSV File'))
            ->add('import', 'submit', array('label' => 'Import'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            //todo Ajouter une validation sur le mime type du fichier
            // et gerer les erreurs.
            $file = $form['attachment']->getData();
            $em = $this->getDoctrine()->getManager();


            /**
             * Pour eviter de faire pleins d'appels a la base je conserve les genres, artistes et albums connus.
             * todo: Faire attention a la taille de ses tableaux. En cas de gros uploads ca risque de faire depasser
             * la memoire allouée a php. Optims: Fixer une taille limite et les vider quand ca depasse, Conserver les plus 
             * utilisés ....
             */
            $genres = array();
            $albums = array();
            $artistes = array();

            if (($handle = fopen($file->getPathname(), 'r')) !== false) {
                //Drop the headers (first line)
                fgetcsv($handle, 1000, ';');
                while(($data = fgetcsv($handle, 1000, ';')) !== false) {
                    $title = $data[0];
                    $rawDuration = explode(':', $data[1]);
                    $duration = 60 * (int)$rawDuration[0] + $rawDuration[1];
                    $artistName = $data[2];
                    $albumName = $data[3];
                    $genreName = $data[4];

                    //Genre
                    if (isset($genres[$genreName])) {
                        //Local cache
                        $genre = $genres[$genreName];
                    } else {
                        //Database
                        $genre = $em->getRepository('AppBundle:Genre')->findOneByNomGenre($genreName);
                        if (!$genre) {
                            $genre = new Genre();
                            $genre->setNomGenre($genreName);
                            $em->persist($genre);
                        }

                        //Add to local cache
                        $genres[$genre->getNomGenre()] = $genre;
                    }
                    
                    //Artiste
                    if (isset($artistes[$artistName])) {
                        //Local cache
                        $artiste = $artistes[$artistName];
                    } else {
                        //Database
                        $artiste = $em->getRepository('AppBundle:Artiste')->findOneByNomArtiste($artistName);
                        if (!$artiste) {
                            $artiste = new Artiste();
                            $artiste->setNomArtiste($artistName);
                            $em->persist($artiste);
                        }

                        //Add to local cache
                        $artistes[$artiste->getNomArtiste()] = $artiste;
                    }
                    
                    //Album
                    if (isset($albums[$albumName])) {
                        //Local cache
                        $album = $albums[$albumName];
                    } else {
                        //Database
                        $album = $em->getRepository('AppBundle:Album')->findOneByNomAlbum($albumName);
                        if (!$album) {
                            $album = new Album();
                            $album->setNomAlbum($albumName);
                            $album->setArtiste($artiste);
                            $em->persist($album);
                        }

                        //Add to local cache
                        $albums[$album->getNomAlbum()] = $album;
                    }
                   
                   
                    $chanson = new Chansons();
                    $chanson->setNomChanson($title);
                    $chanson->setDureeChanson($duration);
                    $chanson->setGenre($genre);
                    $chanson->setAlbum($album);
                    $chanson->setArtiste($artiste);

                    $em->persist($chanson);
                    $em->flush();
                }
            }
        }

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
