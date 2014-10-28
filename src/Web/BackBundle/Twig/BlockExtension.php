<?php

namespace Web\BackBundle\Twig;

class BlockExtension extends \Twig_Extension
{

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions() {
        return array(
            'vector' => new \Twig_Function_Method($this, 'vector')
        );
    }

    /**
     * @param string $vectorId
     * @return string
     */
    public function vector($vectorId)
    {
        $content = $this->container->get('content_entity')->findOneByVector($vectorId);

        return $content;
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'vector_extension';
    }
}