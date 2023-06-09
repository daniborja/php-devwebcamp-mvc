<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIEvents;
use Controllers\APISpeakers;
use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\EventsController;
use Controllers\GiftsController;
use Controllers\PublicPagesController;
use Controllers\RegisteredController;
use Controllers\SpeakersController;
use MVC\Router;

$router = new Router();


// // // Auth
// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

// Create Account
$router->get('/registro', [AuthController::class, 'register']);
$router->post('/registro', [AuthController::class, 'register']);

// password recovery
$router->get('/olvide-password', [AuthController::class, 'forgotPassword']);
$router->post('/olvide-password', [AuthController::class, 'forgotPassword']);

// reset pass
$router->get('/recuperar-password', [AuthController::class, 'resetPassword']);
$router->post('/recuperar-password', [AuthController::class, 'resetPassword']);

// confirm account
$router->get('/mensaje', [AuthController::class, 'message']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmAccount']);




// // // admin
$router->get('/admin/dashboard', [DashboardController::class, 'index']);


$router->get('/admin/ponentes', [SpeakersController::class, 'index']);
$router->get('/admin/ponentes/crear', [SpeakersController::class, 'create']);
$router->post('/admin/ponentes/crear', [SpeakersController::class, 'create']);
$router->get('/admin/ponentes/editar', [SpeakersController::class, 'edit']);
$router->post('/admin/ponentes/editar', [SpeakersController::class, 'edit']);
$router->post('/admin/ponentes/eliminar', [SpeakersController::class, 'delete']);


$router->get('/admin/eventos', [EventsController::class, 'index']);
$router->get('/admin/eventos/crear', [EventsController::class, 'create']);
$router->post('/admin/eventos/crear', [EventsController::class, 'create']);
$router->get('/admin/eventos/editar', [EventsController::class, 'edit']);
$router->post('/admin/eventos/editar', [EventsController::class, 'edit']);
$router->post('/admin/eventos/eliminar', [EventsController::class, 'delete']);

$router->get('/api/eventos-horario', [APIEvents::class, 'index']);
$router->get('/api/speakers', [APISpeakers::class, 'index']);
$router->get('/api/speaker', [APISpeakers::class, 'speaker']);


$router->get('/admin/registrados', [RegisteredController::class, 'index']);

$router->get('/admin/regalos', [GiftsController::class, 'index']);




// // // public
$router->get('/', [PublicPagesController::class, 'index']);
$router->get('/devwebcamp', [PublicPagesController::class, 'event']);
$router->get('/paquetes', [PublicPagesController::class, 'packages']);
$router->get('/workshops-conferencias', [PublicPagesController::class, 'conferences']);







// Checks and validates existing routes and assigns controller functions to them.
$router->checkRoutes();
