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

    private function checkGets($queryInfo){//checkea los gets posibles e invalida la peticion en caso de bad request
        $columnasItem = array("id", "nombre", "color", "descripcion");
        $columnasCat = array("especie");

        if(isset($_GET['order']) && (strtoupper($_GET['order'])=="DESC" || strtoupper($_GET['order'])=="ASC")){
            $queryInfo->order = $_GET['order'];
        }else if(isset($_GET['order'])){
            $queryInfo->valido = false;
            $queryInfo->reason = "{Parametro order}";
        }

        if(isset($_GET['column'])){
            if(in_array(strtolower($_GET['column']), $columnasItem)){
                $queryInfo->column = "raza.".$_GET['column'];
            }else if(in_array($_GET['column'], $columnasCat)){
                $queryInfo->column = "especie.nombre";
            } else {
                $queryInfo->valido = false;
                $queryInfo->reason = "{Parametro column}";
            }
        }

        
    }

    private function printQueryResult($item, $queryInfo){
        if(!empty($item)) {
            return $this->view->response($item,200);
        }else if($queryInfo->valido){
            $this->view->response("No se encontro en la base de datos", 404);
        }else{
            $this->view->response("Bad request, parametro recibido por GET no valido en $queryInfo->reason", 400);
        }
    }

    private function getOne($params, $queryInfo){
        $id = $params[':ID'];
        if(is_numeric($id)){
            return $this->model->getOneItem($id);
        }else{
            $queryInfo->valido = false;
            $queryInfo->reason = "{Parametro ID}";
        }
        return null;
    }

    private function getGroup($especie, $queryInfo){
            $especie = ucfirst($especie);
            $this->checkGets($queryInfo);

            if(is_numeric($especie)){
                $queryInfo->valido = false;
                $queryInfo->reason = "{Parametro especie}";
            }

            if($queryInfo->valido){
                return $this->model->getItemsOfCat($especie, $queryInfo->column, $queryInfo->order);
            }
            return null;
    }

    public function get($params = []) {
        $item = [];
        $queryInfo = new stdClass();
        $queryInfo->valido = true;
        $queryInfo->column = "raza.nombre";
        $queryInfo->order = "ASC";
        $queryInfo->reason = "valid";

        if(isset($params[':ID'])){//uno solo
            $item = $this->getOne($params, $queryInfo);

        }else if(isset($_GET['especie'])){//pide por especie
            $especie = $_GET['especie'];
            $item = $this->getGroup($especie, $queryInfo);

        }else if(empty($params)){//trae todos los animales
            $this->checkGets($queryInfo);
            if($queryInfo->valido){    
                $item = $this->model->getAllItems($queryInfo->column, $queryInfo->order);
            }
        }

        $this->printQueryResult($item, $queryInfo);
    }















    public function deleteItem($params = []){
        $id = $params[':ID'];
        $item = $this->model->getOneItem($id);
        if (!empty($item)) {
            $this->model->deleteItem($id);
            $item = $this->model->getOneItem($id);
            if(!$item){
                $this->view->response("Item id=$id eliminado con éxito", 200);
            }
        }
        else
        $this->view->response("item id=$id not found", 404);
    }

    public function post($params = []){
        $body = $this->getData();

        if(empty($body->nombre) || empty($body->color) || empty($body->descripcion) || empty($body->especie) || ctype_space($body->nombre) || ctype_space($body->color) || ctype_space($body->descripcion) || ctype_space($body->especie)){
            $this->view->response("Complete los datos", 400);
        }
        else{
            $category = $this->model->getCat($body->especie);
            if(!empty($category)){
                $id = $this->model->addItem($body->nombre, $body->color, $body->descripcion, 
                $body->especie);

                $item = $this->model->getOneItem($id);
                $this->view->response($item, 201);
            }
            else
            $this->view->response("No existe la categoria con id=$body->especie", 400);
        }
    }

    public function put($params = []){
        $id = $params[':ID'];
        $item = $this->model->getOneItem($id);

        if (!empty($item)) {//se fija que exista el item a modificar
            $body = $this->getData();

            if(empty($body->nombre) || empty($body->color) || empty($body->descripcion) || empty($body->especie) || ctype_space($body->nombre) || ctype_space($body->color) || ctype_space($body->descripcion) || ctype_space($body->especie)){//los campos deben estar completos
                $this->view->response("Complete los datos", 400);
            }else{
                $category = $this->model->getCat($body->especie);
                if(!empty($category)){
                    $this->model->modItem($body->nombre, $body->color,                 $body->descripcion, $body->especie, $id);
                    $this->view->response($this->model->getOneItem($id), 200);
                }
                else
                $this->view->response("No existe la categoria con id=$body->especie", 400);
            }
        }
        else
        $this->view->response("item id=$id not found", 404);
       
    }

    private function getData() {
        return json_decode($this->data);
    }

}