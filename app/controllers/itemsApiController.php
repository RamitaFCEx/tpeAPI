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

    public function get($params = []) {
        if(isset($params[':ID'])){
            $id = $params[':ID'];
            $item = $this->model->getOneItem($id);
            if(!empty($item)) {
                return $this->view->response($item,200);
            }
            else 
            $this->view->response("El item con el id=$id no existe", 404);

        }else if(isset($_GET['id_especie_fk'])){
            $especie  = $_GET['id_especie_fk'];
            $item = $this->model->getItemsOfCat($especie);
            if(!empty($item)) {
                return $this->view->response($item,200);
            }
            else 
            $this->view->response("El item con el id=$especie no existe", 404);

        }else if(empty($params)){
            $order="ASC";
            $column="nombre";
            if(isset($_GET['order']) && ($_GET['order']=="ASC" || $_GET['order']=="DESC")){
                $order=$_GET['order'];
            }

            if(isset($_GET['column']) && ($_GET['column']=="id" || $_GET['column']=="color" || $_GET['column']=="descripcion" || $_GET['column']=="id_especie_fk")){
                $column=$_GET['column'];
            }

            $items = $this->model->getAllItems($order, $column);
            if(!empty($items)) {
                return $this->view->response($items,200);
            }
            else 
            $this->view->response("Error, no se han encontrado items", 404);
        }
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
        $this->view->response("Task id=$id not found", 404);
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
        $this->view->response("Task id=$id not found", 404);
       
    }

    private function getData() {
        return json_decode($this->data);
    }

}