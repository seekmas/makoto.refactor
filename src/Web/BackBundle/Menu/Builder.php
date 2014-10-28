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
             ->createManagement()
        ;

        return $this->menu;
    }

    public function createHome()
    {
        $menu = $this->menu;
        $menu->addChild('Home' , ['route' => 'menu.home_page' , 'attributes' => ['icon'=>'fa fa-home']]);

        $menu->addChild('Create' , [ 'label' => 'Create Contents', 'attributes' => ['icon'=>'fa fa-file-o']]);


        $menu['Create']->addChild('Write a news' , ['route' => 'menu.create_newsfeed' , 'attributes' => ['icon'=>'fa fa-pencil-square-o'] ]);
        $menu['Create']->addChild('Add a team member' , ['route' => 'menu.create_team' , 'attributes' => ['icon'=>'fa fa-users'] ]);



        return $this;
    }

    public function createManagement()
    {
        $menu = $this->menu;

        $menu->addChild('Management' , [ 'label' => 'Manage Contents', 'attributes' => ['icon'=>'fa fa-file-o']]);

        $menu['Management']->addChild('Content' , [ 'route' => 'menu.admin_content' , 'attributes' => ['icon'=>'fa fa-share-alt']]);
        $menu['Management']->addChild('News' , [ 'route' => 'menu.list_newsfeed' , 'attributes' => ['icon'=>'fa fa-share-alt']]);
        $menu['Management']->addChild('Team Member' , [ 'route' => 'menu.list_team' , 'attributes' => ['icon'=>'fa fa-users']]);



        return $this;
    }


}