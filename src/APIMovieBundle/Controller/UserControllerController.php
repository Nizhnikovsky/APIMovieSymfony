<?php

namespace APIMovieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use APIMovieBundle\Service;
use Doctrine\ORM\EntityManager;
use APIMovieBundle\Controller\ApiMovieController;

class UserControllerController extends ApiMovieController
{
    /**
     * @Route("/", name="search")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request)
    {
        if (!empty($request->get('search')))
        {
            $title = $request->get('search');
            $service = $this->get('user.service')->getFilmByTitle($title);
            
            if (!empty($service))
            {
                return $this->render('APIMovieBundle:UserController:list.html.twig', array("film"=>$service,"message"=>''));
            }
            else{
                $film = $this->sendRequest($title);
                $film = $this->parseBody($film);
                if (!empty($film) && !(array_key_exists('Error',$film)))
                {
                    $this->get('user.service')->setFilm($film);
                    $service = $this->get('user.service')->getFilmByTitle($title);
                    return $this->render('APIMovieBundle:UserController:list.html.twig', array("film"=>$service,"message"=>''));
                }
                return $this->render('APIMovieBundle:UserController:list.html.twig', array( "message"=>$film["Error"]));
            }
        }
        return $this->render('APIMovieBundle:UserController:view.html.twig', array());
    }

}
