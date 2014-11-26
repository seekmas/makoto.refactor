<?php

namespace App\SocietyBundle\Controller;

use App\SocietyBundle\Api\SaeTOAuthV2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\SocietyBundle\Api\SaeTClientV2;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class WeiboController extends Controller
{
    public function indexAction()
    {

        $weibo = $this->get('weibo.api');
//
//        $c = new SaeTOAuthV2( $weibo->getClientId() , $weibo->getClientSecret() , $_SESSION['token']['access_token']);
//
//        $client = new SaeTClientV2( $weibo->getClientId() , $weibo->getClientSecret() , $_SESSION['token']['access_token']);
////        $c->post('statuses/update' ,
////            [
////                'status' => 'A new status from api.local' ,
////                'visible' => 0 ,
////
////            ]
////        );

        $manager = $this->get('society_login');
        $manager->login(1);


        exit;

        return $this->render('AppSocietyBundle:Weibo:index.html.twig' ,
            [
                'url' => $url ,
                'ms'  => $ms ,
                'user_message' => $uid ,
            ]
        );
    }

    public function callbackAction()
    {
        $o = $this->get('weibo.api');

        if (isset($_REQUEST['code'])) {
            $keys = array();
            $keys['code'] = $_REQUEST['code'];
            $keys['redirect_uri'] = $o->getCallBack();
            try {

                $token = $o->getAccessToken( 'code', $keys );

            } catch (OAuthException $e) {
            }
        }

        if ($token) {
            $_SESSION['token'] = $token;
            setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
            return $this->redirect($this->generateUrl('weibo'));
        } else {
            echo '授权失败。';
        }

        return new Response();
    }

    public function sinaAction()
    {

        $data = json_encode($_REQUEST);

        file_put_contents('../request.log' , $data . "\n", FILE_APPEND);

        $data = file_get_contents('../request.log');

        ld($data);

        return new Response();
    }

    public function saveAction()
    {
        $data = json_encode($_REQUEST);
        file_put_contents($this->get('kernel')->getRootDir().'/../log.txt' , $data , FILE_APPEND);

        return $this->render('AppSocietyBundle:Weibo:save.html.twig'
        );
    }
}
