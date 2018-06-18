<?php
/**
 * Created by PhpStorm.
 * User: Nizhn
 * Date: 16.06.2018
 * Time: 16:46
 */

namespace APIMovieBundle\Service;

use APIMovieBundle\Entity\APIMovie;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraints\Collection;


class UserService implements UserServiceInterface
{
    
    private $em;
    private $movieRepository;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->movieRepository = $entityManager->getRepository('APIMovieBundle:APIMovie');
    }
    
    
    public function setFilm(array $movie)
    {
        if (isset($movie['Title'])) {
            $film = new APIMovie();
            $film->setTitle((isset($movie['Title'])) ? $movie['Title'] : '')
                ->setActors((isset($movie['Actors'])) ? $movie['Actors'] : '')
                ->setAwards((isset($movie['Awards'])) ? $movie['Awards'] : '')
                ->setCountry((isset($movie['Country'])) ? $movie['Country'] : '')
                ->setGenre((isset($movie['Genre'])) ? $movie['Genre'] : '')
                ->setLanguage((isset($movie['Language'])) ? $movie['Language'] : '')
                ->setPoster((isset($movie['Poster'])) ? $movie['Poster'] : '')
                ->setProduction((isset($movie['Production'])) ? $movie['Production'] : '')
                ->setReleased((isset($movie['Released'])) ? $movie['Released'] : '')
                ->setWriter((isset($movie['Writer'])) ? $movie['Writer'] : '')
                ->setYear((isset($movie['Year'])) ? $movie['Year'] : '');
            
            $this->movieRepository->save($film);
            return $film->getId();
        }
        throw new \Exception("Ooops..Film not saved!!!");
    }
    
    public function getFilmByTitle($title)
    {
        $src = ' APIMovieBundle\Entity\APIMovie';
        $movie = $this->em->createQuery(
            "SELECT p
        FROM $src p
        WHERE p.title LIKE :title"
        )->setParameter('title', '%' . $title . '%')->getOneOrNullResult();
        
        if (empty($movie)) {
            return 0;
        } else {
            $result = array();
            $result['Title'] = $movie->getTitle();
            $result['Actors'] = $movie->getActors();
            $result['Awards'] = $movie->getAwards();
            $result['Country'] = $movie->getCountry();
            $result['Genre'] = $movie->getGenre();
            $result['Language'] = $movie->getLanguage();
            $result['Poster'] = $movie->getPoster();
            $result['Production'] = $movie->getProduction();
            $result['Released'] = $movie->getReleased();
            $result['Writer'] = $movie->getWriter();
            $result['Year'] = $movie->getYear();
            return $result;
        }
    }
}