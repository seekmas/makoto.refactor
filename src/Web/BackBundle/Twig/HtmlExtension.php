<?php

namespace Web\BackBundle\Twig;

class HtmlExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('chr', [$this, 'chr']),
            new \Twig_SimpleFilter('currency', [$this, 'currency']),
            new \Twig_SimpleFilter('drop_p', [$this, 'drop_p']),
            new \Twig_SimpleFilter('drop_br', [$this, 'drop_br']),
            new \Twig_SimpleFilter('drop_blank', [$this, 'drop_blank']),
            new \Twig_SimpleFilter('keywords', [$this, 'keywords']),

        );
    }

    public function getFunctions()
    {
        return
            [
                'now' => new \Twig_Function_Method($this, 'now') ,
                'start_with' => new \Twig_Function_Method($this, 'start_with') ,
            ];
    }

    public function currency($number)
    {
        return '<i class="fa fa-jpy"></i> '.$number;
    }

    public function chr($number)
    {
        return chr($number);
    }

    public function now()
    {
        return time();
    }

    public function start_with($string , $character)
    {
        if(preg_match('/^'.$character.'/' , $string))
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function drop_p($str)
    {
        $str = preg_replace('/\<p\>/' , '' , $str);
        $str = preg_replace('/\<\/p\>/' , '' , $str);

        return $str;
    }

    public function drop_br($str)
    {
        $str = preg_replace('/\<br\>/' , '' , $str);
        $str = preg_replace('/\<br\/\>/' , '' , $str);
        return $str;
    }

    public function drop_blank($str)
    {
        $str = preg_replace('/&nbsp;/' , '' , $str);

        return $str;
    }

    public function keywords($keywords)
    {
        $list = [
            '杨凯' => '高级顾问' ,
            '全球改善' => '____' ,
        ];

        foreach($list as $key => $value)
        {
            $keywords = preg_replace('/'.$key.'/u' , $value , $keywords);
        }

        return $keywords;
    }

    public function getName()
    {
        return 'html_extension';
    }
}