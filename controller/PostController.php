<?php
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/AuthMiddleware.php';

class PostController extends Controller {
    public function index() {
        AuthMiddleware::check();
        $posts = (new Post())->getAll();
        $this->response($posts);
    }

    public function store() {
        $user = AuthMiddleware::check();
        $data = $this->input();
        $created = (new Post())->create($user->id, $data['title'], $data['content']);
        $this->response(["message" => $created ? "Post created" : "Failed"], $created ? 200 : 400);
    }
}
