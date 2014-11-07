<?php

namespace App\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Web\BackBundle\Controller\Controller;

class LessonController extends Controller
{
    public function indexAction(Request $request)
    {

        $lessons = $this->get('lesson_paginator')->orderBy('id' , 'desc')->getPaginator();

        return $this->render('AppFrontBundle:Lesson:index/index.html.twig' ,

            [
                'lessons' => $lessons ,
            ]
        );
    }
}