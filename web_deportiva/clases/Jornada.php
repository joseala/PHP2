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
    public function clasificacionJornada() {
        $clasificacion = [];
        while ($partido = $this->partidos->iterate()){
            if(is_numeric($partido->getGL())){              
                if($partido->getGL() > $partido->getGV()){
                    $clasificacion [$partido->getEquipoL()->getNombre()]=['GF'=> $partido->getGL() ,'GC'=> $partido->getGV() ,'Puntos'=> 3 ];
                    $clasificacion [$partido->getEquipoV()->getNombre()]=['GF'=> $partido->getGV() ,'GC'=> $partido->getGL() ,'Puntos'=> 0 ];      
                }elseif ($partido->getGL() < $partido->getGV()) {
                    $clasificacion [$partido->getEquipoL()->getNombre()]=['GF'=> $partido->getGL() ,'GC'=> $partido->getGV() ,'Puntos'=> 0 ];
                    $clasificacion [$partido->getEquipoV()->getNombre()]=['GF'=> $partido->getGV() ,'GC'=> $partido->getGL() ,'Puntos'=> 3 ];
                }else{
                   $clasificacion [$partido->getEquipoL()->getNombre()]=['GF'=> $partido->getGL() ,'GC'=> $partido->getGV() ,'Puntos'=> 1 ];
                   $clasificacion [$partido->getEquipoV()->getNombre()]=['GF'=> $partido->getGV() ,'GC'=> $partido->getGL() ,'Puntos'=> 1 ];
                }
            }
        }
         return $clasificacion;   
    }

   
}
