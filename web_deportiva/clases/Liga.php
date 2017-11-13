<?php
require_once 'Collection.php';
require_once 'Equipo.php';
class Liga {
    
    private $nombre;
    private $jornadas;
    private $equipos;
    
    public function __construct($nombre = null,$jornadas = null, $equipos = null) {
        
        $this->nombre = $nombre;
        $this->jornadas = new Collection();
        $this->equipos = new Collection();
        
    }
    function getNombre() {
        return $this->nombre;
    }

    function getJornadas() {
        return $this->jornadas;
    }

    function getEquipos() {
        return $this->equipos;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setJornadas($jornadas) {
        $this->jornadas = $jornadas;
    }

    function setEquipos($equipo) {
            $this->equipos->add($equipo);          
    }
    public function creaJornadas() {
        $valor = $this->equipos->getNumObjects();
        if ($this->equipos->getNumObjects() % 2 != 0) {
            $equipo = new Equipo("Descanso",$valor+1);
            $this->equipos->add($equipo);
        }
        $equipos = [];
        while($actual = $this->equipos->iterate()){
            array_push($equipos,$actual->getNombre());
        }
        
        $fecha = date(DATE_ATOM, mktime(0, 0, 0, 2, 27, 2014));
        for ($i = 0; $i < count($equipos) - 1; $i++) {
            $locales = array_slice($equipos, 0, (count($equipos) / 2));
            $visitantes = array_reverse(array_slice($equipos, (count($equipos) / 2)));
            
            $fecha = strtotime ( '+7 day' , strtotime ( $fecha ) ) ;
            $fecha = date ( 'Y-m-j' , $fecha );
            $miJornada = new Jornada($i+1,$fecha);
            $miJornada->persist($bd, $this->id);
            for ($j = 0; $j < count($visitantes); $j++) {
                $liga[$i][$j]['local'] = $locales[$j];
                $liga[$i][$j]['visitante'] = $visitantes[$j];
                $partido = new Partido($locales[$j],"",$visitantes[$j],""); 
                $partido->persist($bd, $miJornada->getId());
                $miJornada->getPartidos()->add($partido);
            }
            $equipoBase = array_shift($equipos);
            array_unshift($equipos, array_pop($equipos));
            array_unshift($equipos, $equipoBase);
        }
        foreach ($liga as $jornada) {
            $fecha = strtotime ( '+7 day' , strtotime ( $fecha ) ) ;
            $fecha = date ( 'Y-m-j' , $fecha );
            $miJornada = new Jornada($fecha,$i);
            $miJornada->persist($bd, $this->id);
            $this->jornadas->add($miJornada);
            foreach ($jornada as $partido) {
                $local = $partido['visitante'];
                $visitante = $partido['local'];
                $partido = new Partido($visitante,"",$local,""); 
                $partido->persist($bd, $miJornada->getId());
                $miJornada->getPartidos()->add($partido);   
                
            }
        }
        
    }


}
