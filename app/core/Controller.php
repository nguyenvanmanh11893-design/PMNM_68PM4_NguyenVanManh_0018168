<?php
class Controller {
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($viewLayout, $data = []) {
        extract($data);
        require_once '../app/views/' . $viewLayout . '.php';
    }
}