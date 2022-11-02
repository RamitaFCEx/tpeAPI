<?php
class itemsModel{

    function conect(){
        try{
            $db = new PDO('mysql:host=localhost;'
                     .'dbname=db_zooDigital; charset=utf8', 'root','');
            return $db;
        }catch(PDOException  $ex){
            header(HOME);
        }
    }

    function getAllItems(){//busca todos los animales de la tabla raza y hace join con la tabla especies, necesario para el titulo 
        $db = $this->conect();
        $sentencia = $db->prepare( "SELECT raza.*,especie.nombre as especie FROM raza JOIN especie ON raza.id_especie_fk = especie.id ORDER BY raza.nombre ASC");
    
        try{
            $sentencia->execute();
            $razas = $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $razas;
        }catch(PDOException  $ex){
            header(HOME);
        }
    }


}