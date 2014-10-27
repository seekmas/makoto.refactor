<?php

namespace Web\BackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class ContentController extends Controller
{
    public function indexAction(Request $request)
    {
        $content_paginator = $this->get('content_paginator')->getPaginator(20);

        return $this->render('WebBackBundle:Content:index/index.html.twig' ,
            [
                'content_paginator' => $content_paginator
            ]
        );
    }
}