<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/JWTHandler.php';

class AuthController extends Controller {
    public function login() {
        $data = $this->input();
        $user = (new User())->find($data['email'], $data['password']);
        if ($user) {
            $token = JWTHandler::encode(["id" => $user['id'], "email" => $user['email']]);
            $this->response(["status" => true, "message"=>"User Login Successfully","token" => "Bearer ".$token]);
        } else {
            $this->response(["error" => "Invalid credentials"], 401);
        }
    }

    public function register() {
        $data = $this->input();
        $created = (new User())->create($data['name'], $data['email'], $data['password']);
        if ($created) {
            $this->response(["message" => "User registered"]);
        } else {
            $this->response(["error" => "Registration failed"], 400);
        }
    }
}