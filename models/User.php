<?php

namespace Model;

class User extends ActiveRecord
{
    protected static $table = 'users';
    protected static $dbColumns = ['id', 'name', 'last_name', 'email', 'password', 'confirmed', 'token', 'is_admin'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->lastName = $args['last_name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmed = $args['confirmed'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->isAdmin = $args['is_admin'] ?? 0;
    }


    public function checkLogin()
    {
        if (!$this->email) {
            self::$alerts['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'Email no válido';
        }
        if (!$this->password) {
            self::$alerts['error'][] = 'El Password no puede ir vacio';
        }
        return self::$alerts;
    }


    public function registrationValidations()
    {
        if (!$this->name) {
            self::$alerts['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->lastName) {
            self::$alerts['error'][] = 'El Apellido es Obligatorio';
        }
        if (!$this->email) {
            self::$alerts['error'][] = 'El Email es Obligatorio';
        }
        if (!$this->password) {
            self::$alerts['error'][] = 'El Password no puede ir vacio';
        }
        if (strlen($this->password) < 6) {
            self::$alerts['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        if ($this->password !== $this->password2) {
            self::$alerts['error'][] = 'Los password son diferentes';
        }
        return self::$alerts;
    }


    public function validateUserEmail()
    {
        if (!$this->email) {
            self::$alerts['error'][] = 'El Email es Obligatorio';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'Email no válido';
        }
        return self::$alerts;
    }


    public function validatePassword()
    {
        if (!$this->password) {
            self::$alerts['error'][] = 'El Password no puede ir vacio';
        }
        if (strlen($this->password) < 6) {
            self::$alerts['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        return self::$alerts;
    }

    public function newPassValidations(): array
    {
        if (!$this->password_actual) {
            self::$alerts['error'][] = 'El Password Actual no puede ir vacio';
        }
        if (!$this->password_nuevo) {
            self::$alerts['error'][] = 'El Password Nuevo no puede ir vacio';
        }
        if (strlen($this->password_nuevo) < 6) {
            self::$alerts['error'][] = 'El Password debe contener al menos 6 caracteres';
        }
        return self::$alerts;
    }


    // gen temp confirm token
    public function createTempToken()
    {
        $this->token = md5(uniqid());
    }


    public function comprobar_password(): bool
    {
        return password_verify($this->password_actual, $this->password);
    }


    public function hashPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }


    public function crearToken(): void
    {
        $this->token = uniqid();
    }
}
