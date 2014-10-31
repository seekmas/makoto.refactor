<?php

namespace Web\BackBundle\Attachment;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Web\BackBundle\Entity\Attachment;

class RestAttachmentManager implements AttachmentInterface
{
    private $kernel;
    private $security_context;
    private $request;
    private $doctrine;
    private $attachment_entity;

    public function __construct( $kernel , $security_context , RequestStack $request , $doctrine , $attachment_entity)
    {
        $this->kernel = $kernel;
        $this->security_context = $security_context;
        $this->request = $request->getCurrentRequest();
        $this->doctrine = $doctrine;
        $this->attachment_entity = $attachment_entity;
    }

    public function save()
    {
        $user = $this->security_context->getToken()->getUser();

        //var_dump($_FILES['file']);
        $file = $_FILES['file'];
        $type = preg_replace('/^.+\//' , '' , $file['type']);
        $fileName = $user->getid().'_'.md5(date('YmdHis')) . '.' . $type;
        $path = $this->kernel->getRootDir(). '/../web/attachments/' . $user->getId() .'/' ;
        move_uploaded_file( $file['tmp_name'] , $path . $fileName);
        $fileMd5 = md5_file($path . $fileName);
        $mime = $file['type'];


        $em = $this->doctrine->getManager();
        $attachment = new Attachment();
        $em->persist($attachment);
        $attachment->setCreatedAt(new \Datetime());
        $attachment->setMd5($fileMd5);
        $attachment->setFile($fileName);
        $attachment->setPath($path);
        $attachment->setMime($mime);
        $em->flush();

        return '/attachments/'.$user->getId() . '/' . $fileName;
    }
}