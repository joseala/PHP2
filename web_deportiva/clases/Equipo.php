<?php
require_once 'Collection.php';
class Equipo {
    
    private $id;
    private $nombre;
    private $Gf;
    private $Gc;
    private $puntos;
    
    public function __construct($nombre = null,$id = null) {
        
        $this->id = $id;
        $this->nombre = $nombre;
        $this->Gf = 0;
        $this->Gc = 0;
        $this->puntos = 0;       
    }
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getGf() {
        return $this->Gf;
    }

    function getGc() {
        return $this->Gc;
    }

    function getPuntos() {
        return $this->puntos;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setGf($Gf) {
        $this->Gf += $Gf;
    }

    function setGc($Gc) {
        $this->Gc += $Gc;
    }

    function setPuntos($puntos) {
        $this->puntos += $puntos;
    }


}
