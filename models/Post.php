<?php
require_once __DIR__ . '/../core/Model.php';

class Post extends Model {
    public function getAll() {
        $result = $this->conn->query("SELECT * FROM posts");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($user_id, $title, $content) {
        $stmt = $this->conn->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $title, $content);
        return $stmt->execute();
    }
}
