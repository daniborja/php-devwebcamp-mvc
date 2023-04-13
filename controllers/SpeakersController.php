<?php

namespace Controllers;

use Classes\Paging;
use Model\Speaker;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;


class SpeakersController
{
    public static function index(Router $router)
    {
        if (!isAdmin()) header('Location: /login');

        // // paging:
        $current_page = $_GET['page'];
        $current_page = filter_var($current_page, FILTER_VALIDATE_INT);
        if (!$current_page || $current_page < 1) header('Location: /admin/ponentes?page=1');

        $records_per_page = 10;
        $total_records = Speaker::countTotalRecords();

        $pagination = new Paging($current_page, $records_per_page, $total_records);
        if ($pagination->totalPages() < $current_page) header('Location: /admin/ponentes?page=1');


        // // render
        $speakers = Speaker::paging($records_per_page, $pagination->offset());

        $router->render('admin/speakers/index', [
            'title' => 'Ponentes / Conferencistas',
            'speakers' => $speakers,
            'pagination' => $pagination->paginationTemplate()
        ]);
    }


    public static function create(Router $router)
    {
        if (!isAdmin()) header('Location: /login');

        $alerts = [];
        $speaker = new Speaker;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isAdmin()) header('Location: /login');

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
            'speaker' => $speaker,
            'networks' => json_decode($speaker->networks)
        ]);
    }


    public static function edit(Router $router)
    {
        if (!isAdmin()) header('Location: /login');
        $alerts = [];

        // check id
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) header('Location: /admin/ponentes');

        $speaker = Speaker::find($id);
        if (!$speaker) header('Location: /admin/ponentes');

        // img
        $speaker->current_image = $speaker->image;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isAdmin()) header('Location: /login');

            // hanlde img: If there is an img, then update it
            if (!empty($_FILES['image']['tmp_name'])) {
                $images_dir = '../public/img/speakers';

                // delete previous img
                unlink($images_dir . '/' . $speaker->current_image . ".png");
                unlink($images_dir . '/' . $speaker->current_image . ".webp");

                // create dir if it does not exist
                if (!is_dir($images_dir)) mkdir($images_dir, 0755, true);

                $image_png = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $image_webp = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('webp', 80);


                $image_name = md5(uniqid(rand(), true));

                $_POST['image'] = $image_name;
            } else {
                $_POST['image'] = $speaker->current_image;
            }

            // rewrite networks associtive arr
            $_POST['networks'] = json_encode($_POST['networks'], JSON_UNESCAPED_SLASHES);
            $speaker->synchronize($_POST);
            $alerts = $speaker->validate();

            if (empty($alerts)) {
                // save img
                if (isset($image_name)) {
                    $image_png->save($images_dir . '/' . $image_name . '.png');
                    $image_webp->save($images_dir . '/' . $image_name . '.webp');
                }

                $result = $speaker->save();

                if ($result) header('Location: /admin/ponentes');
            }
        }


        $router->render('admin/speakers/edit', [
            'title' => 'Editar Ponente',
            'alerts' => $alerts,
            'speaker' => $speaker,
            'networks' => json_decode($speaker->networks)
        ]);
    }


    public static function delete()
    {
        if (!isAdmin()) header('Location: /login');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isAdmin()) header('Location: /login');

            $id = $_POST['id'];
            $speaker = Speaker::find($id);
            if (!isset($speaker)) header('Location: /admin/ponentes');

            $result = $speaker->delete();
            if ($result) header('Location: /admin/ponentes');
        }
    }
}
