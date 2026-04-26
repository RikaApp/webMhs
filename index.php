<?php

require_once "controller.php";

$controller = new Controller();

$action = $_GET['action'] ?? 'index';
$method = $_SERVER['REQUEST_METHOD'];

switch ($action) {

    case 'save_mk':
        if ($method === 'POST') {
            $controller->saveMK();
        } else {
            http_response_code(405);
            echo "Method Not Allowed";
        }
        break;

    case 'get_mk':
        if ($method === 'GET') {
            $controller->getMK();
        } else {
            http_response_code(405);
            echo "Method Not Allowed";
        }
        break;

    case 'save_mahasiswa':
        if ($method === 'POST') {
            $controller->saveMahasiswa();
        } else {
            http_response_code(405);
            echo "Method Not Allowed";
        }
        break;

    default:
        $controller->index();
        break;
}
