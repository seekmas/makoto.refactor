<?php

namespace Web\BackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Web\BackBundle\Entity\Attachment;
use Web\BackBundle\Entity\Newsfeed;
use Web\BackBundle\Form\AttachmentType;
use Web\BackBundle\Form\NewsfeedType;

class NewsfeedController extends Controller
{
    public function indexAction(Request $request)
    {
        $newsfeed_paginator = $this->get('newsfeed_paginator')->getPaginator();

        return $this->render('WebBackBundle:Newsfeed:index/index.html.twig' ,
            [
                'newsfeed_paginator' => $newsfeed_paginator
            ]
        );
    }

    public function createAction(Request $request)
    {
        $newsfeed = new Newsfeed();
        $form = $this->getForm($newsfeed , new NewsfeedType() , $request);
        if($form->isValid())
        {
            $newsfeed->setCreatedAt(new \Datetime());

            $em = $this->getManager();
            $em->persist($newsfeed);
            $em->flush();
            $this->flash('success' , 'New newsfeed is created ! ');
            return $this->redirect('menu.create_newsfeed');
        }

        return $this->render('WebBackBundle:Newsfeed:create/index.html.twig' ,
            [
                'form' => $form->createView()
            ]
        );
    }

    public function editAction(Request $request , $id)
    {
        $newsfeed = $this->get('newsfeed_entity')->find($id);
        $form = $this->getForm($newsfeed,new NewsfeedType(),$request);
        if($form->isValid())
        {
            $em = $this->getManager();
            $em->persist($newsfeed);
            $em->flush();
            $this->flash('success' ,'Newsfeed is updated ! ');
            return $this->redirect('menu.list_newsfeed');
        }

        return $this->render('WebBackBundle:Newsfeed:edit/index.html.twig' ,
            [
                'id'=>$id ,
                'form'=>$form->createView()
            ]
        );
    }

    public function uploadAction(Request $request , $id)
    {
        $newsfeed = $this->get('newsfeed_entity')->find($id);

        $attachment = new Attachment();
        $form = $this->getForm($attachment ,new AttachmentType() , $request);
        if($form->isValid())
        {
            $attachment_manager = $this->get('attachment.manager');
            $attachment_manager->bind($form,$attachment);
            $attachment_manager->save();
            $attachment->setNewsfeed($newsfeed);

            $em = $this->getManager();
            $em->persist($attachment);

            $em->flush();

            $this->flash('success' , 'A new photo is uploaded ! ');
            return $this->redirect('link.upload_newsfeed' ,
                [
                    'id'=>$id ,
                ]
            );
        }

        return $this->render('WebBackBundle:Newsfeed:upload/index.html.twig' ,
            [
                'form'=> $form->createView() ,
                'newsfeed' => $newsfeed ,
            ]
        );
    }

    public function unlinkAction($id)
    {
        $attachment = $this->get('attachment_entity')->find($id);

        $newsfeed = $attachment->getNewsfeed();

        $this->get('attachment.manager')->unlink($attachment);

        $em = $this->getDoctrine()->getManager();

        $em->remove($attachment);

        $em->flush();

        $this->flash('success' , 'You delete a cover picture ! ');

        return $this->redirect('link.upload_newsfeed' , ['id'=>$newsfeed->getId()]);
    }

    public function removeAction(Request $request , $id)
    {
        $em = $this->getDoctrine()->getManager();

        $news = $this->get('newsfeed_entity')->find($id);

        foreach($news->getAttachment() as $attachment)
        {
            $em->remove($attachment);
            $em->flush();
        }

        $news->setAttachment(NULL);

        $em->remove($news);

        $em->flush();

        $this->flash('success' , 'You remove a news ! ');

        return $this->redirect('menu.list_newsfeed');
    }
}