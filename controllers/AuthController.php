<?php

namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class AuthController
{
    public static function login(Router $router)
    {
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            $alerts = $user->checkLogin();

            if (empty($alerts)) {
                $user = User::where('email', $user->email);

                if (!$user || !$user->confirmed || !password_verify($_POST['password'], $user->password)) {
                    User::setAlert('error', 'Se ha producido un problema al iniciar sesión. Comprueba tu correo electrónico y contraseña y verifica tu cuenta, o crea una cuenta.');
                } else {
                    // login
                    session_start();
                    $_SESSION['id'] = $user->id;
                    $_SESSION['name'] = $user->name;
                    $_SESSION['email'] = $user->email;
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['is_admin'] = $user->is_admin ?? null;

                    // role-based redirection
                    if ($user->is_admin) header('Location: /admin/dashboard');
                    else header('Location: /finalizar-registro');
                }
            }
        }

        $alerts = User::getAlerts();

        // render view
        $router->render('auth/login', [
            'title' => 'Iniciar Sesión',
            'alerts' => $alerts,
        ]);
    }

    public static function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
    }

    public static function register(Router $router)
    {
        $alerts = [];
        $user = new User;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->synchronize($_POST);
            $alerts = $user->registrationValidations();

            if (empty($alerts)) {
                $isAlreadyRegistered = User::where('email', $user->email);

                if ($isAlreadyRegistered) {
                    User::setAlert('error', 'El Usuario ya esta registrado');
                    $alerts = User::getAlerts();
                } else {
                    // // create new user
                    $user->hashPassword();

                    // clear user active record - delete att
                    unset($user->password2);

                    $user->createTempToken();

                    // send email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendConfirmationEmail();


                    $result = $user->save();
                    if ($result) header('Location: /mensaje');
                }
            }
        }

        // render view
        $router->render('auth/register', [
            'title' => 'Crea tu cuenta',
            'user' => $user,
            'alerts' => $alerts,
        ]);
    }

    public static function forgotPassword(Router $router)
    {
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            $alerts = $user->validateUserEmail();

            if (empty($alerts)) {
                $user = User::where('email', $user->email);

                if ($user && $user->confirmed) {
                    $user->createTempToken();
                    unset($user->password2);

                    $user->save();

                    // send emial
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendRecoveryInstructions();

                    User::setAlert('success', 'Hemos enviado las instrucciones a tu email');
                } else {
                    User::setAlert('error', 'El Usuario no existe o no esta confirmado');
                }
            }
        }

        $alerts = User::getAlerts();


        // render view
        $router->render('auth/forgot-password', [
            'title' => 'Olvide mi password',
            'alerts' => $alerts,
        ]);
    }

    public static function resetPassword(Router $router)
    {
        $alerts = [];
        $hasError = false;
        $token = s($_GET['token']);
        if (!$token) header('Location: /');

        $user = User::where('token', $token);
        if (empty($user)) {
            User::setAlert('error', 'Token Inválido!');
            $hasError = true;
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->synchronize($_POST);
            $alerts = $user->validatePassword();

            if (empty($alerts)) {
                $user->hashPassword();
                unset($user->password2);

                $user->token = null;

                $result = $user->save();

                if ($result) header('Location: /login');
            }
        }


        $alerts = User::getAlerts();

        // render view
        $router->render('auth/reset-password', [
            'title' => 'Reestablecer Password',
            'alerts' => $alerts,
            'hasError' => $hasError,
        ]);
    }

    public static function message(Router $router)
    {
        // render view
        $router->render('auth/message', [
            'title' => 'Cuenta Creada Exitosamente',
        ]);
    }

    public static function confirmAccount(Router $router)
    {
        $token = s($_GET['token']);
        if (!$token) header('Location: /');

        $user = User::where('token', $token);
        if (empty($user)) {
            User::setAlert('error', 'Token Inválido, la cuenta no se confirmó');
        } else {
            // confirm account
            $user->confirmed = 1;
            $user->token = null;
            unset($user->password2);

            $user->save();

            User::setAlert('success', 'Cuenta Comprobada Exitosamente');
        }

        $alerts = User::getAlerts();


        // render view
        $router->render('auth/confirm-account', [
            'title' => 'Confirma tu cuenta UpTask',
            'alerts' => $alerts
        ]);
    }
}
