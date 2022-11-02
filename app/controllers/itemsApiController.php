<?php
require_once 'app/models/itemsModel.php';
require_once 'app/views/itemsView.php';
class itemsApiController{
    protected $model;
    protected $view;
    protected $data;

    public function __construct(){
        $this->model = new itemsModel();
        $this->view = new itemsView();

        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    // function get($params = []) {
    //     $tareas = $this->model->getAllItems();
    //     return $this->view->response($tareas, 200);
    // }

    public function getAllItems($params = null) {
        $items = $this->model->getAllItems();
        return $this->view->response($items, 200);
    }

    public function getTarea($params = null) {
        $id = $params[':ID'];
        
    }

    public function test() {
        header("Content-Type: application/json");
        header("HTTP/1.1 " . 200 . " " . "OK");
        echo json_encode("true");
    }
}