<?php


namespace Web\BackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Web\BackBundle\Entity\Attachment;
use Web\BackBundle\Entity\Background;
use Web\BackBundle\Form\AttachmentType;
use Web\BackBundle\Form\BackgroundType;

class UploadController extends Controller
{

    public function backgroundAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $background = new Background();
        $attachment = new Attachment();

        $form = $this->getForm($attachment,new AttachmentType() , $request);
        if($form->isValid())
        {

            $em->persist($attachment);
            $manager = $this->get('attachment.manager');
            $manager->bind($form,$attachment);
            $file = $manager->save();
            $em->flush();


            if($backgrounds = $this->get('background_entity')->findOneBy(['active' => true]))
            {
                $backgrounds->setActive(false);
                $em->persist($backgrounds);
                $em->flush();
            }

            $background->setFilePath($file);
            $background->setActive(true);
            $em->persist($background);
            $em->flush();

            $this->flash('success' , 'Background is updated ! ');
            return $this->redirect('background_upload');
        }

        $bg = $this->get('background_entity')->findAll();

        return $this->render('WebBackBundle:Upload:background/index.html.twig' ,
            [
                'form' => $form->createView() ,
                'bg'   => $bg ,
            ]
        );
    }

    public function activeAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $background = $this->get('background_entity')->findOneBy(['active' => true]);

        if($background)
        {
            $background->setActive(false);
            $em->persist($background);
            $em->flush();
        }

        $bg = $this->get('background_entity')->find($id);
        $bg->setActive(true);
        $em->persist($bg);
        $em->flush();

        return $this->redirect('background_upload');
    }

    public function imageAction()
    {

        $filePath = $this->get('rest_attachment.manager')->save();

        $serializer = $this->get('jms_serializer');

        $json_data = $serializer->serialize( ['filelink' => $filePath] , 'json');

        $headers = ['Content-Type' => 'application/json'];

        return new Response( $json_data , 200 , $headers );

    }
}