<?php

namespace Controllers;

use Model\Speaker;

class APISpeakers
{
    public static function index()
    {
        if (!isAdmin()) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $speakers = Speaker::all();

        echo json_encode($speakers);
    }
}
