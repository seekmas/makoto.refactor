<?php


namespace Web\BackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Web\BackBundle\Entity\CaseCategory;
use Web\BackBundle\Entity\CaseLayout;
use Web\BackBundle\Entity\Cases;
use Web\BackBundle\Form\CaseCategoryType;
use Web\BackBundle\Form\CasesType;

class CasesController extends Controller
{
    public function indexAction(Request $request , $id = 0)
    {

        $em = $this->getManager();

        if( $id == 0)
        {
            $cases = new Cases();
            $cases->setCreatedAt(new \Datetime());
            $cases->setClick(0);
        }else
        {
            $cases = $this->get('case_entity')->find($id);
        }



        $form = $this->getForm($cases, new CasesType() , $request);
        if($form->isValid())
        {
            $em->persist($cases);
            $em->flush();

            $this->flash('success' , 'Success');

            return $this->redirect('link.edit_case' , ['id' => $cases->getId()]);
        }
        return $this->render('WebBackBundle:Cases:index/index.html.twig' , ['form' => $form->createView()]);
    }

    public function categoryAction(Request $request)
    {
        $em = $this->getManager();
        $category = new CaseCategory();
        $form = $this->getForm($category,new CaseCategoryType(),$request);
        if($form->isValid())
        {
            $em->persist($category);
            $em->flush();
            $this->flash('success' , 'Success');
            return $this->redirect('menu.case_category');
        }

        return $this->render('WebBackBundle:Cases:category/index.html.twig' , ['form' => $form->createView()]);
    }

    public function loadDataAction()
    {
        $layouts = [
            'Horizontal' ,
            'Vertical' ,
            'LeftToRight'
        ];


        $em = $this->getManager();
        foreach($layouts as $layout)
        {
            if(! $this->get('case_layout_entity')->findOneByName($layout))
            {
                $new_layout = new CaseLayout();
                $em->persist($new_layout);
                $new_layout->setName($layout);
                $em->flush();
            }
        }

        return new Response();

    }

    public function listAction()
    {
        $pagination = $this->get('case_paginator');

        $cases = $pagination->getPaginator();

        return $this->render('WebBackBundle:Cases:list/index.html.twig' , ['cases' => $cases]);
    }
}