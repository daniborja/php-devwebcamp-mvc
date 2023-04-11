<?php

namespace Controllers;

use Model\Speaker;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;


class SpeakersController
{
    public static function index(Router $router)
    {
        $router->render('admin/speakers/index', [
            'title' => 'Ponentes / Conferencistas'
        ]);
    }

    public static function create(Router $router)
    {
        $alerts = [];
        $speaker = new Speaker;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // hanlde img:
            if (!empty($_FILES['image']['tmp_name'])) {
                $images_dir = '../public/img/speakers';

                // create dir if it does not exist
                if (!is_dir($images_dir)) mkdir($images_dir, 0755, true);

                $image_png = Image::make($_FILES['image']['tmp_name']->fit(800, 800)->encode('png', 80));
                $image_webp = Image::make($_FILES['image']['tmp_name']->fit(800, 800)->encode('webp', 80));

                $image_name = md5(uniqid(rand(), true));

                $_POST['image'] = $image_name;
            }

            $speaker->synchronize($_POST);  // no perder data del form when err
            $alerts = $speaker->validate();


            
        }


        $router->render('admin/speakers/create', [
            'title' => 'Registrar Ponente',
            'alerts' => $alerts,
            'speaker' => $speaker
        ]);
    }
}
