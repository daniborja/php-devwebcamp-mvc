<?php

namespace Controllers;

use Model\Speaker;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;


class SpeakersController
{
    public static function index(Router $router)
    {
        $speakers = Speaker::all();


        $router->render('admin/speakers/index', [
            'title' => 'Ponentes / Conferencistas',
            'speakers' => $speakers
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

                $image_png = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $image_webp = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('webp', 80);


                $image_name = md5(uniqid(rand(), true));

                $_POST['image'] = $image_name;
            }

            // rewrite networks associtive arr
            $_POST['networks'] = json_encode($_POST['networks'], JSON_UNESCAPED_SLASHES);

            $speaker->synchronize($_POST);  // no perder data del form when err
            $alerts = $speaker->validate();


            // create speaker
            if (empty($alerts)) {
                // save imgs - fileSystem
                $image_png->save($images_dir . '/' . $image_name . '.png');
                $image_webp->save($images_dir . '/' . $image_name . '.webp');

                // persistimagen
                // debugging($speaker);
                $result = $speaker->save();

                if ($result) header('Location: /admin/ponentes');
            }
        }


        $router->render('admin/speakers/create', [
            'title' => 'Registrar Ponente',
            'alerts' => $alerts,
            'speaker' => $speaker
        ]);
    }


    public static function edit(Router $router)
    {
        $alerts = [];

        // check id
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) header('Location: /admin/ponentes');

        $speaker = Speaker::find($id);
        if(!$speaker) header('Location: /admin/ponentes');


        $router->render('admin/speakers/edit', [
            'title' => 'Editar Ponente',
            'alerts' => $alerts,
            'speaker' => $speaker
        ]);
    }
}
