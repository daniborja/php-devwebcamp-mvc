<?php

namespace Model;

class Event  extends ActiveRecord
{
    protected static $table = 'events';
    protected static $dbColumns = ['id', 'name', 'description', 'available_places', 'category_id', 'day_id', 'hour_id', 'speaker_id'];


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->available_places = $args['available_places'] ?? '';
        $this->category_id = $args['category_id'] ?? '';
        $this->day_id = $args['day_id'] ?? '';
        $this->hour_id = $args['hour_id'] ?? '';
        $this->speaker_id = $args['speaker_id'] ?? '';
    }


    public function validate()
    {
        if (!$this->name) {
            self::$alerts['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->description) {
            self::$alerts['error'][] = 'La descripción es Obligatoria';
        }
        if (!$this->category_id  || !filter_var($this->category_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Elige una Categoría';
        }
        if (!$this->available_places  || !filter_var($this->available_places, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Añade una cantidad de Lugares Disponibles';
        }
        // several options:
        if (!$this->day_id  || !filter_var($this->day_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Elige el Día del evento';
        }
        if (!$this->hour_id  || !filter_var($this->hour_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Elige la hora del evento';
        }
        if (!$this->speaker_id || !filter_var($this->speaker_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Selecciona la persona encargada del evento';
        }

        return self::$alerts;
    }
}
