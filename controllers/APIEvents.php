<?php

namespace Controllers;

use Model\EventSchedule;

class APIEvents
{
    public static function index()
    {
        if (!isAdmin()) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }


        // paging
        $day_id = $_GET['day_id'] ?? '';
        $category_id = $_GET['category_id'] ?? '';

        $day_id = filter_var($day_id, FILTER_VALIDATE_INT);
        $category_id = filter_var($category_id, FILTER_VALIDATE_INT);
        if (!$day_id || !$category_id) {
            echo json_encode([]);
            return;
        };


        // consult db
        $events = EventSchedule::whereArray(['day_id' => $day_id, 'category_id' => $category_id]) ?? [];

        echo json_encode($events);
    }
}
