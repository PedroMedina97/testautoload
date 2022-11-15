<?php

namespace Utils;

use mysqli;

require_once "db.php";

class Helpers
{

    public static function insert(string $name_table, $atributes)
    {
        global $db;
        foreach ($atributes as $row => $value) {
            $items = [];
            foreach ($value as $item) {
                if (is_string($item)) {
                    $val = mysqli_real_escape_string($db, $item);
                    array_push($items, "'$val'");
                } else {
                    array_push($items, $item);
                }
            }
            $data = implode(", ", $items);
            //$query = "INSERT INTO $name_table VALUES (null, $data, NOW(), NOW())";
            $query = "INSERT INTO $name_table VALUES (null, $data)";
            $sql = $db->query($query);
        }
        return $sql;
    }

    public static function update(string $name_table, $atributes, int $id)
    {
        global $db;
        $attr = [$atributes];
        foreach ($attr as $row => $value) {
            $items = [];
            foreach ($value as $col => $item) {
                if (is_string($item)) {
                    $val = mysqli_real_escape_string($db, $item);
                    array_push($items, $col . "= '$val'");
                } else {
                    array_push($items, $col . "= " . $item);
                }
            }
            //$sql = "UPDATE $name_table SET $row WHERE id= '$id'";
            $data = implode(", ", $items);
            $query = "UPDATE $name_table SET $data, updated_at= NOW() WHERE id= '$id'";
            //var_dump($query);
            //die();
            $sql = $db->query($query);
        }
        return $sql;
    }

    public static function getAllAtributes(string $name_table)
    {
        global $db;
        $sql = $db->query("SELECT * FROM $name_table");
        return $sql->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById(string $name_table, int $id)
    {
        global $db;
        $sql = $db->query("SELECT * FROM $name_table WHERE id = $id");
        return $sql->fetch_all(MYSQLI_ASSOC);
    }

    public static function search(string $name_table, array $cols, string $query)
    {
        global $db;
        $sql = $db->query("SELECT * FROM " . $name_table . " WHERE " . implode(' or ', $cols) . " LIKE '%" . $query . "%';");
        return $sql->fetch_all(MYSQLI_ASSOC);
    }

    public static function escape(array $querys)
    {
        global $db;
        $data = [];
        foreach ($querys as $query) {
            array_push($data, mysqli_real_escape_string($db, $query));
        }
        return $data;
    }

    public static function destroy(string $name_table, int $id)
    {
        global $db;
        $query = "DELETE FROM $name_table WHERE id= $id";
        $sql = $db->query($query);
        return $sql;
    }

}
