<?php

namespace Classes;

use Abstracts\Entity;
require_once "./config/db.php";


class User extends Entity{

    public function insertUser(String $nombre, String $apellidos, String $email, String $password)
    {
        global $db;
        $nombre = mysqli_real_escape_string($db,$nombre);
        $apellidos = mysqli_real_escape_string($db,$apellidos);
        $email = mysqli_real_escape_string($db,$email);
        $password = mysqli_real_escape_string($db,$password);
        $pass = password_hash(($password), PASSWORD_BCRYPT, ['cost' => 4]);
        $exists_email = $db->query("SELECT * FROM usuarios WHERE email = '$email'");
        $exists_email = $exists_email->num_rows;
        if ($exists_email > 0) {
            return false;
        } else {
            $sql = $db->query("INSERT INTO usuarios (nombre, apellidos, email, password, created_at, updated_at) VALUES ('$nombre', '$apellidos', '$email', '$pass', NOW(), NOW())");
            return true;
        }

    }

    public function login(string $email, string $password){
        global $db;
        $email = mysqli_real_escape_string($db,$email);
        $user = $db->query("SELECT * FROM usuarios WHERE email = '$email'");
        if($user && $user->num_rows == 1){
            $usuario = $user->fetch_all(MYSQLI_ASSOC);
            $verify = password_verify($password, $usuario[0]['password']);
            //var_dump($verify);
            //die();
            if($verify === true){
                $result = $usuario;
            }else{
                $result = "password incorrect";
            }
        }
        return $result;
    }
}