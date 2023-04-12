<?php

namespace Controllers;

use Model\Category;
use MVC\Router;

class EventsController
{
    public static function index(Router $router)
    {
        $router->render('admin/events/index', [
            'title' => 'Conferencias y Workshops'
        ]);
    }


    public static function create(Router $router)
    {
        $alerts = [];
        $categories = Category::all();
        


        $router->render('admin/events/create', [
            'title' => 'Registrar Evento',
            'alerts' => $alerts,
            'categories' => $categories
        ]);
    }
}
