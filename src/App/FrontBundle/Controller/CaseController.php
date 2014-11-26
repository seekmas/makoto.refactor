<?php

namespace App\FrontBundle\Controller;

use Web\BackBundle\Controller\Controller;

class CaseController extends Controller
{
    public function indexAction()
    {
        $categories = $this->get('case_category_entity')->findAll();

        $cases = $this->get('case_entity')
                      ->createQueryBuilder('c')
                      ->select('c')
                      ->orderBy('c.click' , 'desc')
                      ->setFirstResult(0)
                      ->setMaxResults(20)
                      ->getQuery()
                      ->getResult();

        $latest = $this->get('case_entity')
            ->createQueryBuilder('c')
            ->select('c')
            ->orderBy('c.createdAt' , 'desc')
            ->setFirstResult(0)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

        return $this->render('AppFrontBundle:Case:index/index.html.twig' ,
            [
                'categories' => $categories ,
                'cases' => $cases ,
                'latest' => $latest ,
            ]
        );
    }

    public function readAction($id)
    {
        $case_entity = $this->get('case_entity');
        $case = $case_entity->find($id);

        $em = $this->getManager();
        $em->persist($case);
        $case->setClick($case->getClick()+1);
        $em->flush();

        return $this->render('AppFrontBundle:Case:read/index.html.twig' ,
            [
                'case' => $case
            ]
        );
    }

}