<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$body = json_decode(file_get_contents("php://input"), true);