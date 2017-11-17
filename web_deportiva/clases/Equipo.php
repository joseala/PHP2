<?php
require_once 'Collection.php';
class Equipo {
    
    private $id;
    private $nombre;
      
    public function __construct($nombre = null,$id = null) {
        
        $this->id = $id;
        $this->nombre = $nombre;
               
    }
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    
    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

}
