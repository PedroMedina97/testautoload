<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$time = time();
$key = 'example_key';

$token = array(
    'iat' => $time,
    'exp' => $time + (60 * 60),
    'idUsuario' => '1'
);

$jwt = JWT::encode($token, $key);
$decoded = JWT::decode($jwt, $key, array('HS256'));
var_dump($jwt);
var_dump($decoded);