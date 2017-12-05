<?php


class Linea {
    private $id;
    private $idProducto;
    private $cantidad;
    
    function __construct($idProducto = null, $cantidad = null, $id = null) {
        $this->id = $id;
        $this->idProducto = $idProducto;
        $this->cantidad = $cantidad;
    }
    function getId() {
        return $this->id;
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function persist($dbh) {
        
        
    }
    public function getByCredencialId($dbh){
        
    }
    public function delete($dbh) {
        
    }

}
