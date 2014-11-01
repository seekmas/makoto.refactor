<?php

namespace Web\BackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Web\BackBundle\Entity\Attachment;
use Web\BackBundle\Entity\Team;
use Web\BackBundle\Form\AttachmentType;
use Web\BackBundle\Form\TeamType;

class TeamController extends Controller
{
    public function indexAction(Request $request , $id = 0)
    {
        if($id)
        {
            $team = $this->get('team_entity')->find($id);
        }else
        {
            $team = new Team();
        }

        $form = $this->getForm($team , new TeamType() , $request);
        if($form->isValid())
        {
            $em = $this->getManager();
            $em->persist($team);
            $em->flush();

            $this->flash('success' , 'A new team member is created ! ');
            return $this->redirect('menu.create_team');
        }

        return $this->render('WebBackBundle:Team:index/index.html.twig' ,
            [
                'team' => $team ,
                'form' => $form->createView()
            ]
        );
    }

    public function listAction()
    {
        $teams = $this->get('team_entity')->findAll();
        return $this->render('WebBackBundle:Team:list/index.html.twig' , ['teams' => $teams]);
    }

    public function uploadAction(Request $request , $id)
    {
        $attachment_manager = $this->get('attachment.manager');
        $em = $this->getManager();
        $team = $this->get('team_entity')->find($id);

        $attachment = new Attachment();
        $form = $this->getForm($attachment ,new AttachmentType() , $request);

        if($form->isValid())
        {
            if($team->getAttachment())
            {
                $attachment_unlink = $team->getAttachment();
                $attachment_unlink->setTeam(NULL);

                $attachment_manager->unlink($team->getAttachment());

                $em->remove($attachment_unlink);
                $em->flush();
            }

            $attachment_manager->bind($form , $attachment);
            $attachment_manager->save();

            $attachment->setTeam($team);

            $em->persist($attachment);
            $em->flush();

            $this->flash('success' , 'a new photo is uploaded ! ');
            return $this->redirect('link.upload_team' , ['id'=>$id]);
        }

        return $this->render('WebBackBundle:Team:upload/index.html.twig' ,
            [
                'form' => $form->createView() ,
                'team' => $team ,
            ]
        );
    }

    public function removeAction($id , $ensure = 0)
    {

        $em = $this->getDoctrine()->getManager();

        $member = $this->get('team_entity')->find($id);

        if($ensure)
        {
            if($member->getAttachment())
            {
                $em->remove($member->getAttachment());
                $em->flush();
            }

            $em->remove($member);
            $em->flush();

            $this->flash('success' , 'You delete a member');

            return $this->redirect('menu.list_team');
        }

        return $this->render('WebBackBundle:Team:remove/index.html.twig' , ['member' => $member]);
    }

}