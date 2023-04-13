<?php

namespace Controllers;

use Classes\Paging;
use Model\Category;
use Model\Day;
use Model\Event;
use Model\Hour;
use Model\Speaker;
use MVC\Router;

class EventsController
{
    public static function index(Router $router)
    {
        if (!isAdmin()) header('Location: /login');

        // // paging
        $current_page = $_GET['page'];
        $current_page = filter_var($current_page, FILTER_VALIDATE_INT);
        if (!$current_page || $current_page < 1) header('Location: /admin/eventos?page=1');

        $records_per_page = 10;
        $total_records = Event::countTotalRecords();
        $pagination = new Paging($current_page, $records_per_page, $total_records);
        if ($pagination->totalPages() < $current_page) header('Location: /admin/eventos?page=1');


        // // render
        $events = Event::paging($records_per_page, $pagination->offset());
        foreach ($events as $event) {
            $event->category = Category::find($event->category_id);
            $event->day = Day::find($event->day_id);
            $event->hour = Hour::find($event->hour_id);
            $event->speaker = Speaker::find($event->speaker_id);
        }

        $router->render('admin/events/index', [
            'title' => 'Conferencias y Workshops',
            'events' => $events,
            'pagination' => $pagination->paginationTemplate()
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
