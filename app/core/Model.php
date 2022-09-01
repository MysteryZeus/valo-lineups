<?php

class Model {
    public $id = -1;
    private $found = FALSE;

    public function __construct() {        
    }

    public function update() {
    }

    public static function create($data) {
        $class_name = get_called_class();        
        $table_name = strtolower(preg_replace('/\B([A-Z])/', '_$1', $class_name));

        $keys = array_keys($data);
        $values = array_values($data);
        $sql = "INSERT INTO $table_name (" . implode(', ', $keys) . ') '
            . 'VALUES (:' . implode(', :', $keys) . ');';
        
        if (Database::insert($sql, $data)) {
            $class = new $class_name;
            foreach ($data as $key => $value) {
                $class->$key = $value;
            }
            $class->found = TRUE;
            $class->id = Database::$connection->lastInsertId();
            return $class;
        }
        return NULL;
    }

    public static function find($data = []) {
        $class_name = get_called_class();
        $table_name = strtolower(preg_replace('/\B([A-Z])/', '_$1', $class_name));
        
        $conditions = [];
        $params = [];

        foreach ($data as $condition) {
            $k = array_keys($condition[1])[0];
            $v = array_values($condition[1])[0];
            $conditions[] = "$k $condition[0] :$k";
            $params[$k] = $v;
        }

        $sql = "SELECT * FROM $table_name";
        if (count($conditions) > 0) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }
        $sql .= ';';

        $results = Database::fetch($sql, $params, $table_name);       
        $objects = [];

        foreach ($results as $result) {
            $obj = new $class_name;
            foreach($result as $k => $v) {
                $obj->$k = $v;
            }
            $obj->found = TRUE;
            $objects[] = $obj;
        }

        return $objects;
    }

    public function delete() {
    }
}