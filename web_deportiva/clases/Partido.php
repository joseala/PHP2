<?php
 
class Partido {

    private $id;
    private $equipoL;
    private $gL;
    private $equipoV;
    private $gV;
    
    public function __construct($id = null, $equipoL = null ,$gL = null ,$equipoV = null,$gV = null) {
        
        $this->id = $id;
        $this->equipoL = $equipoL;
        $this->gL = $gL;
        $this->equipoV = $equipoV;
        $this->gV = $gV;
        
    }
    function getEquipoL() {
        return $this->equipoL;
    }

    function getGL() {
        return $this->gL;
    }

    function getEquipoV() {
        return $this->equipoV;
    }

    function getGV() {
        return $this->gV;
    }

    function setEquipoL($equipoL) {
        $this->equipoL = $equipoL;
    }

    function setGL($gL) {
        $this->gL = $gL;
    }

    function setEquipoV($equipoV) {
        $this->equipoV = $equipoV;
    }

    function setGV($gV) {
        $this->gV = $gV;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }


}
