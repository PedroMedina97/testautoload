<?php
include_once 'includes/headers.php';

use Classes\User;
use Classes\Router;

$router = new Router();
$user = new User();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $parameter = $router->getParam();
        if ($parameter) {
            $data = $user->getById("usuarios", $parameter);
            if ($data) {
                $response = array(
                    "status" => "success",
                    "data" => $data
                );
                echo json_encode($response);
            } else {
                $response = array(
                    "res" => false,
                    "msg" => "Category not found"
                );
                echo json_encode($response);
            }
        } else {
            $data = $user->getAll("usuarios");
            $response = false;
            if ($data) {
                $response = array(
                    "status" => "success",
                    "data" => $data
                );
                echo json_encode($response);
            } else {
                $response = array(
                    "res" => false,
                    "msg" => "Category not found"
                );
                echo json_encode($response);
            }
        }

        break;
    case 'POST':
        $data = $user->insertUser($body['nombre'], $body['apellidos'], $body['email'], $body['password']);
        //$data = $user->create("usuarios", $body);
        if ($data) {
            $response = array(
                "status" => "success",
                "data" => $data
            );
            echo json_encode($response);
        } else {
            $response = array(
                "res" => false,
                "msg" => "Couldn't insert the row"
            );
            echo json_encode($response);
        }
        break;
    case 'PUT':
        $parameter = $router->getParam();
        if ($parameter != null) {
            $data = $user->update("usuarios", $body, $parameter);
            if ($data) {
                $response = array(
                    "status" => "success",
                    "msg" => "update successfully"
                );
                echo json_encode($response);
            } else {
                $response = array(
                    "res" => false,
                    "msg" => "Couldn't update the row"
                );
                echo json_encode($response);
            }
        }else{
            $response = array(
                "status" => "error",
                "msg" => "parameter not found"
            );
            echo json_encode($response);
        }
        break;
    case 'DELETE':
        $parameter = $router->getParam();
        if ($parameter != null) {
            $data = $user->delete("usuarios", $parameter);
            if ($data) {
                $response = array(
                    "status" => "success",
                    "msg" => "delete successfully"
                );
                echo json_encode($response);
            } else {
                $response = array(
                    "res" => false,
                    "msg" => "Couldn't delete the row"
                );
                echo json_encode($response);
            }
        }else{
            $response = array(
                "status" => "error",
                "msg" => "parameter not found"
            );
            echo json_encode($response);
        }
        break;
    default:
        echo "404  METHOD NOT FOUND";
}
