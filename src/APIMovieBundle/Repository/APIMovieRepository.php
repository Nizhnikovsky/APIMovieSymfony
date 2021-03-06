<?php

namespace APIMovieBundle\Repository;

use APIMovieBundle\Entity\APIMovie;
use Doctrine\ORM\EntityManager;

/**
 * APIMovieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class APIMovieRepository extends \Doctrine\ORM\EntityRepository
{
    public function save(APIMovie $movie)
    {
        $em = $this->getEntityManager();
        $em->persist($movie);
        $em->flush();
        return $movie->getId();
    }
}
