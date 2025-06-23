<?php

class AuthMiddleware
{
    public static function check()
    {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            self::unauthorized("Authorization header missing");
        }

        if (!preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            self::unauthorized("Invalid token format");
        }

        $user = JWTHandler::decode($matches[1]);

        if (!$user) {
            self::unauthorized("Invalid or expired token");
        }

        return $user;
    }

    private static function unauthorized($msg)
    {
        http_response_code(401);
        echo json_encode(["status" => false, "message" => $msg]);
        exit;
    }
}
