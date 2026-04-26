<?php

require_once "model.php";

class Controller {

    private $model;

    public function __construct() {
        $this->model = new Model();
    }

    public function index() {
        require "view.php";
    }

    public function saveMK() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            $this->response(false, "Data MK tidak valid");
            return;
        }

        $this->model->saveMK($data);
        $this->response(true, "Mata kuliah berhasil disimpan");
    }

    public function getMK() {
        header('Content-Type: application/json');
        echo json_encode($this->model->getMK());
    }

    public function saveMahasiswa() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            $this->response(false, "Data mahasiswa tidak valid");
            return;
        }

        $this->model->saveMahasiswa($data);
        $this->response(true, "Mahasiswa berhasil disimpan");
    }

    private function response($success, $message, $data = null) {
        header('Content-Type: application/json');
        echo json_encode([
            "success" => $success,
            "message" => $message,
            "data" => $data
        ]);
    }
}
