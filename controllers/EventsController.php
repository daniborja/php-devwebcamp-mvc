<?php

namespace Controllers;

use Model\Category;
use Model\Day;
use Model\Hour;
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

        $categories = Category::all('ASC');
        $days = Day::all('ASC');
        $hours = Hour::all('ASC');


        $router->render('admin/events/create', [
            'title' => 'Registrar Evento',
            'alerts' => $alerts,
            'categories' => $categories,
            'days' => $days,
            'hours' => $hours,
        ]);
    }
}
