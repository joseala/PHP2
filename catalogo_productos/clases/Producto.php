<?php

class Producto {
    private $id;
    private $idCategoria;
    private $nombre;
    private $precio;
    
    function __construct($nombre = null, $precio = null, $idCategoria = null, $id = null) {
        $this->id = $id;
        $this->idCategoria = $idCategoria;
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }
    function getIdCategoria() {
        return $this->idCategoria;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    public function persist($dbh) {
        $query = "INSERT INTO producto (idCategoria,nombre,precio) VALUES (:idCategoria,:nombre,:precio)";
        $insert = $dbh->prepare($query);
        $persistido = $insert->execute(array(":idCategoria" => $this->idCategoria, ":nombre" => $this->nombre, ":precio" => $this->precio));
        if($persistido){
            $this->setId($dbh->lastInsertId());
        }
    }
    
    public function updateProducto($dbh) {
        $query = "UPDATE producto SET idCategoria = :idCategoria,nombre = :nombre, precio = :precio WHERE id = :id";
        $update = $dbh->prepare($query);
        $update->execute(array(":id" => $this->id,":idCategoria" => $this->idCategoria ,":nombre" => $this->nombre ,":precio" => $this->precio )); 
    }
    
     public static function deleteProducto($dbh,$id) {
        
        $query = "DELETE FROM producto WHERE id = :id";
        $delete = $dbh->prepare($query);
        $delete->execute(array(":id" => $id));  
        
    }
}
