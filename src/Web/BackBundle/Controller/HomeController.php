<?php

namespace Web\BackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Web\BackBundle\Entity\Catalog;
use Web\BackBundle\Entity\Content;
use Web\BackBundle\Form\CatalogType;
use Web\BackBundle\Form\ContentType;

class HomeController extends Controller
{

    public function defaultAction(Request $request)
    {

        $router = $this->get('router');
        $collection = $router->getRouteCollection();
        $allRoutes = $collection->all();


        return $this->render('WebBackBundle:Home:default/index.html.twig' ,
            [
                'allRoutes' => $allRoutes
            ]
        );
    }

    public function indexAction(Request $request)
    {
        $content = new Content();
        $form = $this->getForm($content , new ContentType() , $request);
        if($form->isValid())
        {
            $content->setCreatedAt(new \Datetime());
            $vector = $content->getVector();
            $ContentIsExisted = $this->get('content_entity')->findOneBy(['vector' => $vector ]);

            if($ContentIsExisted)
            {
                $this->flash('danger' , 'Error , vector name is duplicated ! ');
                ld($ContentIsExisted);
                exit;
                return $this->redirect('admin_home');
            }

            $em = $this->getManager();
            $em->persist($content);
            $em->flush();
            $this->flash('success' , 'content is saved');
            return $this->redirect('menu.admin_content');
        }

        return $this->render('WebBackBundle:Home:index/index.html.twig' , ['form'=>$form->createView()]);
    }

    public function catalogAction(Request $request)
    {
        $catalog = new Catalog();
        $form = $this->getForm($catalog,new CatalogType(),$request);
        if($form->isValid())
        {
            $em = $this->getManager();
            $em->persist($catalog);
            $em->flush();
        }

        return $this->render('WebBackBundle:Home:catalog/index.html.twig' ,
            [
                'form' => $form->createView() ,
            ]
        );
    }
}
