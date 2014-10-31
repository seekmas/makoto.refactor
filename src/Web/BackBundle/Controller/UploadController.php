<?php


namespace Web\BackBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class UploadController extends Controller
{
    public function imageAction()
    {

        $filePath = $this->get('rest_attachment.manager')->save();

        $serializer = $this->get('jms_serializer');

        $json_data = $serializer->serialize( ['filelink' => $filePath] , 'json');

        $headers = ['Content-Type' => 'application/json'];

        return new Response( $json_data , 200 , $headers );
    }
}