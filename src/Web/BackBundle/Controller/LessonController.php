<?php

namespace Web\BackBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Web\BackBundle\Entity\Attachment;
use Web\BackBundle\Entity\Lesson;
use Web\BackBundle\Form\AttachmentType;
use Web\BackBundle\Form\LessonType;

class LessonController extends Controller
{
    public function indexAction(Request $request , $id = 0)
    {
        $em = $this->getManager();

        if($id > 0)
        {
            $lesson = $this->get('lesson_entity')->find($id);
            if($lesson == NULL)
            {
                throw new EntityNotFoundException();
            }

        }else
        {
            $lesson = new Lesson();
        }

        $form = $this->getForm($lesson , new LessonType() , $request);
        if($form->isValid())
        {
            $lesson->setCreatedAt(new \Datetime());

            $em->persist($lesson);
            $em->flush();
            $this->flash('success' , 'New lesson is updated ! ');

            return $this->redirect('lesson_upload' , ['id' => $lesson->getId()]);
        }

        return $this->render('WebBackBundle:Lesson:index/index.html.twig' , ['form' => $form->createView()]);
    }

    public function listAction(Request $request)
    {
        $paginator = $this->get('lesson_paginator')->getPaginator();

        return $this->render('WebBackBundle:Lesson:list/index.html.twig' ,
            [
                'paginator' => $paginator ,
            ]
        );
    }

    public function uploadAction(Request $request , $id)
    {
        $em = $this->getManager();

        $lesson = $this->get('lesson_entity')->find($id);
        if($lesson == NULL)
        {
            throw new EntityNotFoundException();
        }

        $attachment = new Attachment();
        $form = $this->getForm($attachment,new AttachmentType(),$request);
        if($form->isValid())
        {
            $attachment_manager = $this->get('attachment.manager');
            $attachment_manager->bind($form,$attachment);
            $attachment_manager->save();

            $attachment->setLesson($lesson);

            $em->persist($attachment);
            $em->flush();

            $this->flash('success' , 'An attachment is uploaded ! ');
            return $this->redirect('lesson_upload'  , ['id' => $id]);
        }

        return $this->render('WebBackBundle:Lesson:upload/index.html.twig' ,
            [
                'lesson' => $lesson ,
                'form'   => $form->createView() ,
            ]
        );
    }

    public function deleteAttachmentAction(Request $request , $attachmentId)
    {
        $attachment = $this->get('attachment_entity')->find($attachmentId);
        if($attachment == NULL)
        {
            throw new EntityNotFoundException();
        }

        $lesson = $attachment->getLesson();
        if($lesson == NULL)
        {
            $this->flash('danger' , 'Attachment is not found');
            return $this->redirect('lesson_list');
        }

        $attachment_manager = $this->get('attachment.manager');
        $attachment_manager->unlink($attachment);
        $this->flash('success' , 'An attachment is deleted ! ');
        return $this->redirect('lesson_upload' , ['id' => $lesson->getId()]);

    }

}