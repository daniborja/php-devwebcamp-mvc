<?php

namespace Model;

class Speaker extends ActiveRecord
{
    protected static $table = 'users';
    protected static $dbColumns = ['id', 'name', 'last_name', 'city', 'country', 'image', 'tags', 'networks'];


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->city = $args['city'] ?? '';
        $this->country = $args['country'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->tags = $args['tags'] ?? '';
        $this->networks = $args['networks'] ?? '';
    }

    public function validate()
    {
        if (!$this->name) {
            self::$alerts['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->last_name) {
            self::$alerts['error'][] = 'El Apellido es Obligatorio';
        }
        if (!$this->city) {
            self::$alerts['error'][] = 'La Ciudad es Obligatoria';
        }
        if (!$this->country) {
            self::$alerts['error'][] = 'El País es Obligatorio';
        }
        if (!$this->image) {
            self::$alerts['error'][] = 'La imagen es obligatoria';
        }
        if (!$this->tags) {
            self::$alerts['error'][] = 'El Campo áreas es obligatorio';
        }

        return self::$alerts;
    }
}
