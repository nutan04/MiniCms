<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHandler
{
    private static $secretKey = "20fad51902f91e7fd3039e016a6556b5";

    public static function encode($payload)
    {
        $issuedAt = time();
        $expire = $issuedAt + 3600; // 1 hour
        $token = [
            'iat' => $issuedAt,
            'exp' => $expire,
            'data' => $payload
        ];
        return JWT::encode($token, self::$secretKey, 'HS256');
    }

    public static function decode($token)
    {
        try {
            $decoded = JWT::decode($token, new Key(self::$secretKey, 'HS256'));
            return $decoded->data;
        } catch (Exception $e) {
            return false;
        }
    }
}
