<?php
class especiesModel{

    function conect(){
        
        $db = new PDO('mysql:host=localhost;'
                     .'dbname=db_zooDigital; charset=utf8', 'root','');
        return $db;
        
    }


    function getAllSpecies(){//busca todas las especies de la tabla especie
        $db = $this->conect();
        $sentencia = $db->prepare( "SELECT especie.id, especie.nombre FROM especie ORDER BY especie.nombre ASC");
    
        $sentencia->execute();
        $especies = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $especies;
        
    }
}