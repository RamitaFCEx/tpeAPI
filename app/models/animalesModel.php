<?php
class animalesModel{

    function conect(){
        
        $db = new PDO('mysql:host=localhost;'
                     .'dbname=db_zooDigital; charset=utf8', 'root','');
        return $db;
        
    }

    function getCat($id){
        $db = $this->conect();
        $sentencia = $db->prepare( "SELECT especie.* FROM especie WHERE id=?");
    
        $sentencia->execute(array($id));
        $cat = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $cat;
    }

    function getAllAnimal($column, $order){//busca todos los animales de la tabla raza y hace join con la tabla especies, necesario para el titulo
        $db = $this->conect();
        $sentencia = $db->prepare( "SELECT raza.id,raza.nombre,raza.color,raza.descripcion,especie.nombre as especie FROM raza JOIN especie ON raza.id_especie_fk = especie.id ORDER BY $column $order");
    
        $sentencia->execute();
        $animal = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $animal;
    }

    function getAnimalOfCat($id_especie_fk, $column, $order){
        $db = $this->conect();
        $sentencia = $db->prepare( "SELECT raza.id,raza.nombre,raza.color,raza.descripcion,especie.nombre as especie FROM raza JOIN especie ON raza.id_especie_fk = especie.id WHERE especie.nombre = ? ORDER BY $column $order");
        
        $sentencia->execute(array($id_especie_fk));
        $animal = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $animal;
    }

    function getOneAnimal($id){//busca todos los animales de la tabla raza y hace join con la tabla especies, necesario para el titulo
        $db = $this->conect();
    
        $sentencia = $db->prepare( "SELECT raza.*,especie.nombre as especie FROM raza JOIN especie ON raza.id_especie_fk = especie.id WHERE raza.id = ?");
        
        $sentencia->execute(array($id));
        $animal = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $animal;
    }

    function deleteAnimal($id){
        $db = $this->conect();
        $sentencia = $db->prepare( "DELETE FROM raza WHERE id=?");

        $sentencia->execute(array($id));
    }

    function addAnimal($nombre, $color, $descripcion, $especie){
        $db = $this->conect();
        $sentencia = $db->prepare( "INSERT INTO raza(nombre, color, descripcion, id_especie_fk)"."VALUES(?, ?, ?, ?)");

       
        $sentencia->execute(array($nombre, $color, $descripcion, $especie));
        return $db->lastInsertId();
    }

    function modAnimal($nombre, $color, $descripcion, $especie, $id){
        $db = $this->conect();
        $sentencia = $db->prepare("UPDATE raza SET nombre=? , color=? , descripcion=? , id_especie_fk=? WHERE id=?");
        
        
        $sentencia->execute(array($nombre, $color, $descripcion, $especie, $id));
        return $db->lastInsertId();
    }


}