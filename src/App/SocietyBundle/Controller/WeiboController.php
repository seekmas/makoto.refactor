<?php

namespace App\SocietyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class WeiboController extends Controller
{
    public function indexAction()
    {

        $weibo = $this->get('weibo.api');

        $url = $weibo->getAuthorizeURL($weibo->getCallBack());

        return $this->render('AppSocietyBundle:Weibo:index.html.twig' , ['url' => $url]);
    }

    public function callbackAction()
    {
        $weibo = $this->get('weibo.api');


        if (isset($_REQUEST['code'])) {
            $keys = array();
            $keys['code'] = $_REQUEST['code'];
            $keys['redirect_uri'] = $weibo->getCallBack();
            try {

                $token = $weibo->getAccessToken( 'code', $keys ) ;

            } catch (OAuthException $e) {

            }
        }

        if (isset($token)) {
            $_SESSION['token'] = $token;
            setcookie('weibojs_' . $weibo->client_id, http_build_query($token));
        }

        return new Response();
    }
}
