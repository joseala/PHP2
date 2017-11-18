<?php
require_once 'Collection.php';
require_once 'Equipo.php';
require_once 'Partido.php';
require_once 'Jornada.php';

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
        
        $fecha = date(DATE_ATOM, mktime(0, 0, 0, 10, 26, 2014));
        for ($i = 0; $i < count($equipos) - 1; $i++) {
            $locales = array_slice($equipos, 0, (count($equipos) / 2));
            $visitantes = array_reverse(array_slice($equipos, (count($equipos) / 2)));
            
            $fecha = strtotime ( '+7 day' , strtotime ( $fecha ) ) ;
            $fecha = date ( 'Y-m-j' , $fecha );
            $miJornada = new Jornada($i+1,$fecha);
            
            for ($j = 0; $j < count($visitantes); $j++) {
                $liga[$i][$j]['local'] = $locales[$j];
                $liga[$i][$j]['visitante'] = $visitantes[$j];
                $partido = new Partido($j+1, $this->equipos->getByProperty("nombre", $locales[$j]),"",$this->equipos->getByProperty("nombre", $visitantes[$j]),""); 
                $miJornada->getPartidos()->add($partido);
            }
            $this->jornadas->add($miJornada);
            $equipoBase = array_shift($equipos);
            array_unshift($equipos, array_pop($equipos));
            array_unshift($equipos, $equipoBase);
        }
        
        foreach ($liga as $jornada) {
            $fecha = strtotime ( '+7 day' , strtotime ( $fecha ) ) ;
            $fecha = date ( 'Y-m-j' , $fecha );
            $miJornada = new Jornada($i+=1, $fecha);          
            foreach ($jornada as $partido) {
                $local = $partido['visitante'];
                $visitante = $partido['local'];
                $partido = new Partido($j+=1,$this->equipos->getByProperty("nombre", $visitante),"",$this->equipos->getByProperty("nombre", $local),"");      
                $miJornada->getPartidos()->add($partido);   
                
            }
            $this->jornadas->add($miJornada);
        }
        
    }
    public function generaClasificacion() {
        
        $clasificacion = [];
        while ($equipo = $this->equipos->iterate()){
            $clasificacion [$equipo->getNombre()]=['GF'=> 0 ,'GC'=> 0 ,'GA'=> 0 ,'Puntos'=> 0 ]; 
        }   
        while ($jornada = $this->jornadas->iterate()){
            $clasificacionJornada = $jornada->clasificacionJornada();
            if(!is_null($clasificacionJornada)){
                foreach ($clasificacionJornada as $equipo => $valor) {
                    $clasificacion[$equipo]['GF'] += $valor['GF'];
                    $clasificacion[$equipo]['GC'] += $valor['GC'];
                    $clasificacion[$equipo]['Puntos'] += $valor['Puntos'];
                    $clasificacion[$equipo]['GA'] = $clasificacion[$equipo]['GF']- $clasificacion[$equipo]['GC'];  
                }
            }
        }
               
        $columna_puntos = array_column($clasificacion, 'Puntos');
        $columna_average = array_column($clasificacion, 'GA');
        
        array_multisort($columna_puntos,SORT_DESC,$columna_average,SORT_DESC,$clasificacion);     
        unset($clasificacion['Descanso']);
        return $clasificacion;
    }

    
}
