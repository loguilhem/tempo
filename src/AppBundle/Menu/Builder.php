<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Knp\Menu\Renderer\ListRenderer;
use Knp\Menu\Matcher\Matcher;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function connectMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');             

        $menu->addChild('Se connecter', array('route' => 'fos_user_security_login'));

        return $menu;
    }
    
    public function adminMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');             

        $menu->addChild('Gestion Collaborateurs', array('route' => 'listusers'));
        $menu->addChild('Gestion des Tâches', array('route' => 'listtache'));        
        $menu->addChild('Gestion des Dossiers', array('route' => 'listdossier'));
        $menu->addChild('Gestion du Temps', array('route' => 'listtemps'));
        $menu->addChild('Récapitulatif', array('route' => 'recap'));
        
        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->addChild('Gestion du Temps', array('route' => 'listtempscollaborateur'));

        return $menu;
    }

}
