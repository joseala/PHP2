<?php

class Producto {
    
    private $id;
    private $denominacion;
    private $precio;
    
    function __construct($denominacion = null, $precio = null, $id = null) {
        $this->id = $id;
        $this->denominacion = $denominacion;
        $this->precio = $precio;
    }
    function getId() {
        return $this->id;
    }

    function getDenominacion() {
        return $this->denominacion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDenominacion($denominacion) {
        $this->denominacion = $denominacion;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }
    public function getProductos($dbh) {
        $query = "SELECT * FROM producto";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Producto");
        $consulta->execute();
        $productos = $consulta->fetchAll();
        return $productos;
        
    }

}
