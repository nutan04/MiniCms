<?php
header("Content-Type: application/json");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

require_once './controller/AuthController.php';
require_once './controller/PostController.php';

switch ("$method $uri") {
    case "POST //login":
        (new AuthController())->login();
        break;

    case "POST /MiniCms/register":
        (new AuthController())->register();
        break;

    case "GET /MiniCms/posts":
        (new PostController())->index();
        break;

    case "POST /MiniCms/posts":
        (new PostController())->store();
        break;

    default:
        http_response_code(404);
        echo json_encode(["error" => "Route not found"]);
}
