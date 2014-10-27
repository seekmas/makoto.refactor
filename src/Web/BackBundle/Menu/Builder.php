<?php
// src/Acme/DemoBundle/Menu/Builder.php
namespace Web\BackBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    private $menu;
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $this->menu = $factory->createItem('root');
        $this->createHome()
             ->createContent()
             ->createNewsfeed()
        ;

        return $this->menu;
    }

    public function createHome()
    {
        $menu = $this->menu;

        $menu->addChild('Create' , ['attributes' => ['icon'=>'fa fa-share-alt']]);

        $menu['Create']->addChild('New Catalog' , ['route' => 'menu.create_catalog' , 'attributes' => ['icon'=>'fa fa-share-alt'] ]);
        $menu['Create']->addChild('New Content' , ['route' => 'menu.create_content' , 'attributes' => ['icon'=>'fa fa-share-alt'] ]);
        $menu['Create']->addChild('New Newsfeed' , ['route' => 'menu.create_newsfeed' , 'attributes' => ['icon'=>'fa fa-share-alt'] ]);


        return $this;
    }

    public function createContent()
    {
        $menu = $this->menu;

        $menu->addChild('Content' , [ 'route' => 'menu.admin_content' , 'attributes' => ['icon'=>'fa fa-share-alt']]);
        return $this;
    }

    public function createNewsfeed()
    {
        $menu = $this->menu;
        $menu->addChild('NewsFeed' , [ 'route' => 'menu.list_newsfeed' , 'attributes' => ['icon'=>'fa fa-share-alt']]);
        return $menu;
    }

}