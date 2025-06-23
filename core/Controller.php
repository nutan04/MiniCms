<?php
class Controller
{
    protected function response($data, $code = 200)
    {
        http_response_code($code);
        echo json_encode($data);
    }

    protected function input()
    {
        return json_decode(file_get_contents("php://input"), true);
    }
}
