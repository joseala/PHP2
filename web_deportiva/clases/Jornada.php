<?php

class Jornada {
    
    private $id;
    private $fecha;
    private $partidos;
    
    public function __construct($id = null,$fecha = null, $partidos =null) {
        
        $this->id = $id;
        $this->fecha = $fecha;
        $this->partidos = new Collection();
        
    }
    function getId() {
        return $this->id;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getPartidos() {
        return $this->partidos;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setPartidos($partidos) {
        $this->partidos = $partidos;
    }
    
    public function actualizaPartido($resultados) {
        foreach ($resultados as $x => $partido) {
            $partidoGuardado = $this->partidos->getByProperty('id', $partido['id']);
            $partidoGuardado->setGL($partido['gL']);
            $partidoGuardado->setGV($partido['gV']);
            
        }
    }


}
