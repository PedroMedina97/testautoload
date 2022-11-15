<?php

namespace Abstracts;

use Utils\Helpers;

abstract class Entity{

    public function getAll(string $name_table)
    {
        return Helpers::getAllAtributes($name_table); 
    }

    public function getById(String $name_table, Int $id)
    {
        return Helpers::getById($name_table, $id);
    }
    
    public function create(string $name_table,  array $atributes)
    {
        return Helpers::insert($name_table, $atributes);
    }

    public function update(string $name_table,  $atributes, int $id)
    {
        return Helpers::update($name_table, $atributes, $id);
    }

    public function delete(string $name_table, int $id)
    {  
        return Helpers::destroy($name_table, $id);
    }
}