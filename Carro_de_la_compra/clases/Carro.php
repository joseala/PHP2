<?php


class Carro {
    private $id;
    private $idUsuario;
    private $fecha;
    private $lineas;
    
    function __construct($idUsuario = null, $fecha = null, $id = null) {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->fecha = $fecha;
        $this->lineas = new Collection;
    }
    
    function getId() {
        return $this->id;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getLineas() {
        return $this->lineas;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setLineas($lineas) {
        $this->lineas = $lineas;
    }



}
