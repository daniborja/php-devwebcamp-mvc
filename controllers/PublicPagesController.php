<?php

namespace Controllers;

use MVC\Router;

class PublicPagesController
{
    public static function index(Router $router)
    {

        $router->render('pages/index', [
            'title' => 'Inicio',
        ]);
    }

    public static function event(Router $router)
    {

        $router->render('pages/devwebcamp', [
            'title' => 'Sobre DevWebCamp',
        ]);
    }

    public static function packages(Router $router)
    {

        $router->render('pages/packages', [
            'title' => 'Paquetes DevWebCamp',
        ]);
    }

    public static function conferences(Router $router)
    {

        $router->render('pages/conferences', [
            'title' => 'Conferencias & Workshops',
        ]);
    }

}
