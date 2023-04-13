<?php

namespace Controllers;

use Model\Category;
use Model\Day;
use Model\Event;
use Model\Hour;
use Model\Speaker;
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
        $events = Event::order('hour_id', 'ASC');

        /* $formated_events = [];
        foreach ($events as $event) {
            if ($event->day_id === '1' && $event->category_id === '1') {
                $formated_events['friday_conferences'][] = $event;
            }
            if ($event->day_id === '2' && $event->category_id === '1') {
                $formated_events['saturday_conferences'][] = $event;
            }
            if ($event->day_id === '1' && $event->category_id === '2') {
                $formated_events['friday_workshops'][] = $event;
            }
            if ($event->day_id === '2' && $event->category_id === '2') {
                $formated_events['saturday_workshops'][] = $event;
            }
        } */
        // Definir un arreglo asociativo de claves para cada combinación de día y categoría
        $keyMap = [
            '1_1' => 'friday_conferences',
            '2_1' => 'saturday_conferences',
            '1_2' => 'friday_workshops',
            '2_2' => 'saturday_workshops'
        ];
        // Inicializar el arreglo formated_events con claves vacías para cada combinación de día y categoría
        $formated_events = [];
        foreach ($keyMap as $key => $value) {
            $formated_events[$value] = [];
        }
        // Recorrer los eventos y asignarlos al arreglo correspondiente utilizando las claves generadas dinámicamente
        foreach ($events as $event) {
            $key = $event->day_id . '_' . $event->category_id;

            $event->category = Category::find($event->category_id);
            $event->day = Day::find($event->day_id);
            $event->hour = Hour::find($event->hour_id);
            $event->speaker = Speaker::find($event->speaker_id);

            $formated_events[$keyMap[$key]][] = $event;
        }


        $router->render('pages/conferences', [
            'title' => 'Conferencias & Workshops',
            'events' => $formated_events,
        ]);
    }
}
