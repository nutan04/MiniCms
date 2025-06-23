<?php
require_once __DIR__ . '/../core/Model.php';

class User extends Model {
    public function find($email, $password) {
        $email = $this->conn->real_escape_string($email);
        $result = $this->conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
        return $result->fetch_assoc();
    }

    public function create($name, $email, $password) {
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        return $stmt->execute();
    }
}
