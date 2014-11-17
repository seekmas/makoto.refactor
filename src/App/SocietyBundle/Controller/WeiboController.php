<?php

namespace App\SocietyBundle\Controller;

use App\SocietyBundle\Api\SaeTOAuthV2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\SocietyBundle\Api\SaeTClientV2;

class WeiboController extends Controller
{
    public function indexAction()
    {

        $weibo = $this->get('weibo.api');

        $c = new SaeTOAuthV2( $weibo->getClientId() , $weibo->getClientSecret() , $_SESSION['token']['access_token']);

//        $c->post('statuses/update' ,
//            [
//                'status' => 'A new status from api.local' ,
//                'visible' => 0 ,
//
//            ]
//        );

        $ms = $c->get('statuses/home_timeline');

        $user_message = $c->get('users/show');

        $url = $weibo->getAuthorizeURL($weibo->getCallBack());

        return $this->render('AppSocietyBundle:Weibo:index.html.twig' ,
            [
                'url' => $url ,
                'ms'  => $ms ,
                'user_message' => $user_message ,
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

    public function saveAction()
    {
        
    }
}
