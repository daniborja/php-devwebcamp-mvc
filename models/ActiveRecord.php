<?php

namespace Model;

class ActiveRecord
{

    // db
    protected static $db;
    protected static $table = '';
    protected static $dbColumns = [];

    // alerts and messages
    protected static $alerts = [];

    // def db connection - includes/database.php
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public static function setAlert($tipo, $mensaje)
    {
        static::$alerts[$tipo][] = $mensaje;
    }
    // validation
    public static function getAlerts()
    {
        return static::$alerts;
    }

    public function validar()
    {
        static::$alerts = [];
        return static::$alerts;
    }

    // create/update
    public function save()
    {
        $result = '';
        if (!is_null($this->id)) {
            $result = $this->update();
        } else {
            $result = $this->create();
        }
        return $result;
    }

    public static function all()
    {
        $query = "SELECT * FROM " . static::$table;
        $result = self::sqlQuery($query);
        return $result;
    }

    // find by id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$table  . " WHERE id = $id";
        $result = self::sqlQuery($query);
        return array_shift($result);
    }

    // get register
    public static function get($limit)
    {
        $query = "SELECT * FROM " . static::$table . " LIMIT $limit";
        $result = self::sqlQuery($query);
        return array_shift($result);
    }

    // search by column (WHERE)
    public static function where($column, $value)
    {
        $query = "SELECT * FROM " . static::$table . " WHERE $column = '$value'";
        $result = self::sqlQuery($query);
        return array_shift($result);
    }

    // search for all records belonging to an ID
    public static function belongsTo($column, $value)
    {
        $query = "SELECT * FROM " . static::$table . " WHERE $column = '$value'";
        $result = self::sqlQuery($query);
        return $result;
    }


    // other SQL queries
    public static function SQL($consulta)
    {
        $query = $consulta;
        $result = self::sqlQuery($query);
        return $result;
    }

    // create - crud
    public function create()
    {
        // sanitize data
        $attributes = $this->sanitizeAttributes();

        // insert in db
        $query = " INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";

        // query result
        $result = self::$db->query($query);

        return [
            'result' =>  $result,
            'id' => self::$db->insert_id
        ];
    }

    public function update()
    {
        // sanitize data
        $attributes = $this->sanitizeAttributes();

        // iterate to add each field in db
        $valores = [];
        foreach ($attributes as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$table . " SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        // debugging($query);

        $result = self::$db->query($query);
        return $result;
    }

    // delete - crud | take id from active record
    public function delete()
    {
        $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);
        return $result;
    }

    public static function sqlQuery($query)
    {
        // query db
        $result = self::$db->query($query);

        // iterate results
        $array = [];
        while ($register = $result->fetch_assoc()) {
            $array[] = static::createObject($register);
        }

        // freeing the memory
        $result->free();


        return $array;
    }

    protected static function createObject($register)
    {
        $object = new static;

        foreach ($register as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }

        return $object;
    }



    // identify and link DB attributes
    public function attributes()
    {
        $attributes = [];
        foreach (static::$dbColumns as $column) {
            if ($column === 'id') continue;

            // // try to use camelCase in all place, but not
            // $attributeValue = $column;
            // $column = str_replace('_', '', lcfirst(ucwords($column, '_')));

            $attributes[$column] = $this->$column;
        }

        // debugging($attributes);
        return $attributes;
    }

    public function sanitizeAttributes()
    {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach ($attributes as $key => $value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    public function synchronize($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
