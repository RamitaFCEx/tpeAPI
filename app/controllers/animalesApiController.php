<?php
require_once 'app/models/animalesModel.php';
require_once 'app/views/animalesView.php';
class animalesApiController{
    protected $model;
    protected $view;
    protected $data;

    public function __construct(){
        $this->model = new animalesModel();
        $this->view = new animalesView();
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
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
            }else if(in_array(strtolower($_GET['column']), $columnasCat)){
                $queryInfo->column = "especie.nombre";
            } else {
                $queryInfo->valido = false;
                $queryInfo->reason = "{Parametro column}";
            }
        }


        if(isset($_GET['offset']) && is_numeric($_GET['offset'])){
            $queryInfo->offset = $_GET['offset'];
        }else if(isset($_GET['offset']) && !is_numeric($_GET['offset'])){
            $queryInfo->valido = false;
            $queryInfo->reason = "{Parametro offset}";
        }


        if(isset($_GET['lenght']) && is_numeric($_GET['lenght'])){
            $queryInfo->lenght = $_GET['lenght'];
        }else if(isset($_GET['lenght']) && !is_numeric($_GET['lenght'])){
            $queryInfo->valido = false;
            $queryInfo->reason = "{Parametro lenght}";
        }
    }

    private function printQueryResult($animal, $queryInfo){
        if(!empty($animal)) {
            return $this->view->response($animal,200);
        }else if($queryInfo->valido){
            $this->view->response("No se encontro en la base de datos", 404);
        }else{
            $this->view->response("Bad request, parametro recibido por GET no valido en $queryInfo->reason", 400);
        }
    }

    private function getOne($params, $queryInfo){
        $id = $params[':ID'];
        $this->checkGets($queryInfo);
        if(!is_numeric($id)){
            $queryInfo->valido = false;
            $queryInfo->reason = "{Parametro ID}";
        }

        if ($queryInfo->valido) {
            return $this->model->getOneAnimal($id);
        }
        return null;
    }

    private function getGroup($especie, $queryInfo){
            $especie = ucwords($especie);
            $this->checkGets($queryInfo);

            if(is_numeric($especie)){
                $queryInfo->valido = false;
                $queryInfo->reason = "{Parametro especie}";
            }

            if($queryInfo->valido){
                return $this->model->getAnimalOfCat($especie, $queryInfo->column, $queryInfo->order);
            }
            return null;
    }

    public function get($params = []) {
        $animal = [];
        $queryInfo = new stdClass();
        $queryInfo->valido = true;
        $queryInfo->column = "raza.nombre";
        $queryInfo->order = "ASC";
        $queryInfo->reason = "valid";
        $queryInfo->offset = 0;
        $queryInfo->lenght = null;

        if(isset($params[':ID'])){//uno solo
            $animal = $this->getOne($params, $queryInfo);

        }else if(isset($_GET['especie'])){//pide por especie
            $especie = $_GET['especie'];
            $animal = $this->getGroup($especie, $queryInfo);

        }else if(empty($params)){//trae todos los animales
            $this->checkGets($queryInfo);
            if($queryInfo->valido){    
                $animal = $this->model->getAllAnimal($queryInfo->column, $queryInfo->order);
                $animal = array_slice($animal, $queryInfo->offset, $queryInfo->lenght);
                
            }
        }
        $this->printQueryResult($animal, $queryInfo);
    }

    public function delete($params = []){
        $id = $params[':ID'];

        if(is_numeric($id)){
            $animal = $this->model->getOneAnimal($id);
            if (!empty($animal)) {
                $this->model->deleteAnimal($id);
                $animal = $this->model->getOneAnimal($id);
                if(!$animal){
                    $this->view->response("Animal id=$id eliminado con éxito", 200);
                }else{
                    $this->view->response("El servidor no pudo borrar por una falla interna", 500);
                }
            }
            else
            $this->view->response("Animal id=$id not found", 404);
        }else
        $this->view->response("Solo se aceptan id numericos", 400);

        
    }

    private function checkVoidInputs($body){
        foreach ($body as $k => $v) {
            if (empty($v) || $v==null ){
                return true; 
            }else if (!is_numeric($v) && ctype_space($v)){
                return true; 
            }
        }
        return false;
    }

    public function post($params = null){
        $body = $this->getData();

        if($this->checkVoidInputs($body)){
            $this->view->response("Complete los datos ", 400);
        }
        else{
            $category = $this->model->getCat($body->especie);
            if(!empty($category)){
                $id = $this->model->addAnimal($body->nombre, 
                                            $body->color, 
                                            $body->descripcion, 
                                            $body->especie);

                $animal = $this->model->getOneAnimal($id);
                $this->view->response($animal, 201);
            }
            else
            $this->view->response("No existe la categoria con id=$body->especie", 400);
        }
    }

    public function put($params = []){
        $id = $params[':ID'];
        $animal = $this->model->getOneAnimal($id);

        if (!empty($animal) && is_numeric($id)) {//se fija que exista el item a modificar
            $body = $this->getData();

            if($this->checkVoidInputs($body)){//los campos deben estar completos
                $this->view->response("Complete todos los campos", 400);
            }else{
                $category = $this->model->getCat($body->especie);
                if(!empty($category)){//tiene que existir la categoria
                    $this->model->modAnimal($body->nombre, 
                                            $body->color, 
                                            $body->descripcion, 
                                            $body->especie, 
                                            $id);
                    $this->view->response($this->model->getOneAnimal($id), 201);
                }
                else
                $this->view->response("No existe la categoria con id=$body->especie", 400);
            }

        }else if(!is_numeric($id)){
            $this->view->response("Solo se aceptan id numericos", 400);
        }
        else
        $this->view->response("Animal id=$id not found", 404);
       
    }
}