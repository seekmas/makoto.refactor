<?php


namespace App\SocietyBundle\UserManager;

class LoginManager
{

    private $security_login_manager;
    private $firewall_name;
    private $container;

    public function __construct($security_login_manager , $firewall_name , $container)
    {
        $this->security_login_manager = $security_login_manager;
        $this->firewall_name = $security_login_manager;
        $this->container = $container;
    }

    public function login($user_id)
    {
        $user_entity = $this->container->get('user_entity');
        $user = $user_entity->find($user_id);
        $this->security_login_manager->loginUser($this->firewall_name,$user);
        ld($this->security_login_manager);
    }
}