<?php

namespace Web\BackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Web\BackBundle\Form\ContentType;

class ContentController extends Controller
{
    public function indexAction(Request $request , $catalogId = 0)
    {
        $paginator = $this->get('content_paginator')
                                  ->orderBy('id' , 'desc');
        if($catalogId > 0)
        {
            $paginator->where(array('catalogId' => $catalogId));
        }


        $content_paginator = $paginator->getPaginator(20);

        $catalog = $this->get('catalog_entity')->findAll();

        return $this->render('WebBackBundle:Content:index/index.html.twig' ,
            [
                'content_paginator' => $content_paginator ,
                'catalogId' => $catalogId ,
                'catalog' => $catalog ,
            ]
        );
    }

    public function editAction(Request $request , $id)
    {
        $content = $this->get('content_entity')->find($id);
        $form = $this->getForm($content,new ContentType(),$request);
        if($form->isValid())
        {
            $em = $this->getManager();
            $em->persist($content);
            $em->flush();

            $this->flash('success' , 'The content is updated ! ');
            return $this->redirect('link.admin_edit_by_id' , ['id'=>$id]);
        }

        $catalog = $this->get('catalog_entity')->findAll();

        return $this->render('WebBackBundle:Content:edit/index.html.twig' ,
            [
                'content' => $content ,
                'form' => $form->createView() ,
                'catalog' => $catalog ,
            ]
        );
    }
}