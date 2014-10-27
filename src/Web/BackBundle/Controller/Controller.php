<?php

namespace Web\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\AbstractType;
use Web\BackBundle\Entity\Entity;

class Controller extends BaseController
{
    public function redirect($path , $params = [])
    {
        return parent::redirect(parent::generateUrl($path , $params));
    }

    /**
     * @param string @type
     * @param string @message
     */
    public function flash($type,$message)
    {
        $request = $this->get('request');

        $flash = $request->getSession()->getFlashBag();

        $flash->add($type , $message);
    }

    /**
     * @param Entity $entity
     * @param AbstractType $type
     * @param Request $request
     * @return Form
     */
    public function getForm($entity,$type,Request $request)
    {
        $form = $this->createForm($type ,$entity);
        $form->handleRequest($request);
        return $form;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getManager()
    {
        return $this->getDoctrine()->getManager();
    }
}