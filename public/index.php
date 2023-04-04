<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AuthController;
use MVC\Router;

$router = new Router();


// // Auth
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




// Checks and validates existing routes and assigns controller functions to them.
$router->checkRoutes();