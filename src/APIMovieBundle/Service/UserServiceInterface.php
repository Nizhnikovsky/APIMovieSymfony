<?php
/**
 * Created by PhpStorm.
 * User: Nizhn
 * Date: 16.06.2018
 * Time: 19:31
 */

namespace APIMovieBundle\Service;

use APIMovieBundle\Entity\APIMovie;
use Doctrine\ORM\EntityManager;

interface UserServiceInterface
{
    
    public function getFilmByTitle($title);
    public function setFilm(array $movie);
    
}