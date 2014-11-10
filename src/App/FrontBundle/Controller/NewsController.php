<?php

namespace App\FrontBundle\Controller;

use Web\BackBundle\Controller\Controller;

class NewsController extends Controller
{
    public function indexAction()
    {
        $newsfeed = $this->get('newsfeed_paginator')
            ->where(['publish' => true])
            ->orderBy('createdAt' , 'desc')
            ->getPaginator(10);

        return $this->render('AppFrontBundle:News:index/index.html.twig' ,
            [
                'newsfeed' => $newsfeed ,
            ]
        );
    }

    public function yearAction($year)
    {
        $newsfeed = $this->get('newsfeed_paginator')
            ->where(['publish' => true , 'category' => $year])
            ->orderBy('createdAt' , 'desc')
            ->getPaginator(10);

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