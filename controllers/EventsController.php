<?php

namespace Controllers;

use Model\Category;
use Model\Day;
use Model\Event;
use Model\Hour;
use MVC\Router;

class EventsController
{
    public static function index(Router $router)
    {
        if (!isAdmin()) header('Location: /login');

        $router->render('admin/events/index', [
            'title' => 'Conferencias y Workshops'
        ]);
    }


    public static function create(Router $router)
    {
        if (!isAdmin()) header('Location: /login');

        $alerts = [];

        $categories = Category::all('ASC');
        $days = Day::all('ASC');
        $hours = Hour::all('ASC');

        $event = new Event();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isAdmin()) header('Location: /login');

            $event->synchronize($_POST);  // sync post data with instance
            $alerts = $event->validate();

            if (empty($alerts)) {
                $result = $event->save();

                if ($result) header('Location: /admin/eventos');
            }
        }


        $router->render('admin/events/create', [
            'title' => 'Registrar Evento',
            'alerts' => $alerts,
            'categories' => $categories,
            'days' => $days,
            'hours' => $hours,
            'event' => $event,
        ]);
    }
}
