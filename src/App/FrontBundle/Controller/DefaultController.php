<?php

namespace App\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {


        $background = $this->get('background_entity')->findOneBy(['active' => true]);

        $newsfeed = $this->get('newsfeed_paginator')
                         ->orderBy('createdAt' , 'desc')
                         ->getPaginator(6);

        return $this->render('AppFrontBundle:Default:index/index.html.twig' ,
            [
                'newsfeed' => $newsfeed ,
                'background' => $background ,
            ]
        );
    }

    public function globalAction()
    {

        return $this->render('AppFrontBundle:Default:global/index.html.twig' ,
            [

            ]
        );
    }

    public function investmentsAction()
    {
        return $this->render('AppFrontBundle:Default:investments/index.html.twig');
    }

    public function serviceAction()
    {

        return $this->render('AppFrontBundle:Default:service/index.html.twig');
    }

    public function contactAction()
    {

        $teams = $this->get('team_entity')->findAll();
        return $this->render('AppFrontBundle:Default:contact/index.html.twig' , ['teams' => $teams]);
    }
}
