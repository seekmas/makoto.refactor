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

    public function getName()
    {
        return 'html_extension';
    }
}