<?php
require_once 'app/models/especiesModel.php';
require_once 'app/views/especiesView.php';
class especiesApiController{
    protected $model;
    protected $view;
    protected $data;

    public function __construct(){
        $this->model = new especiesModel();
        $this->view = new especiesView();
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }


    private function getData() {
        return json_decode($this->data);
    }

    public function get(){
        $especies = $this->model->getAllSpecies();
        if (!empty($especies)) {
            $this->view->response($especies, 200);
        }else{
            $this->view->response("NOT FOUND", 404);
        }
        
    }




}