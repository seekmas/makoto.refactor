<?php

namespace App\FrontBundle\Controller;

use Web\BackBundle\Controller\Controller;

class NewsController extends Controller
{
    public function indexAction()
    {
        $newsfeed = $this->get('newsfeed_paginator')
            ->orderBy('createdAt' , 'desc')
            ->getPaginator(6);

        return $this->render('AppFrontBundle:News:index/index.html.twig' ,
            [
                'newsfeed' => $newsfeed ,
            ]
        );
    }

    public function postAction($id)
    {
        $newsfeed = $this->get('newsfeed_entity')->find($id);

        return $this->render('AppFrontBundle:News:post/index.html.twig' , ['newsfeed' => $newsfeed]);
    }
}