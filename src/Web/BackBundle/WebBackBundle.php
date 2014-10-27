<?php

namespace Web\BackBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Web\BackBundle\DependencyInjection\CompilePass\FormTwigPass;

class WebBackBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass( new FormTwigPass());
    }
}
