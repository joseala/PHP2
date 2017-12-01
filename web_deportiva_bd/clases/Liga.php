<?php

class Liga {    
    private $id;
    private $nombre;
    private $jornadas;
    private $equipos;
    
    public function __construct($nombre = null, $id = null) {
        
        $this->id = $id;
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
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    public function creaEquipos($equipos, $dbh) {
        foreach ($equipos as $x => $equipo) {
            $equipo_actual = new Equipo(trim($equipo), $this->id);           
            $equipo_actual->persist($dbh);                  
            $this->equipos->add($equipo_actual);
            
        }
    }
    public function creaJornadas($dbh) {
        $valor = $this->equipos->getNumObjects();
        if ($this->equipos->getNumObjects() % 2 != 0) {
            $equipo = new Equipo("Descanso",$this->id);
            $equipo->persist($dbh); 
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
            //$miJornada = new Jornada($i+1,$fecha);
            $miJornada =  new Jornada($fecha, $this->id);
            $miJornada->persist($dbh);
            for ($j = 0; $j < count($visitantes); $j++) {
                $liga[$i][$j]['local'] = $locales[$j];
                $liga[$i][$j]['visitante'] = $visitantes[$j];
                $partidosIda[] = ["id" => (int)$miJornada->getId(), "local" => $locales[$j],"gl" => "", "visitante" => $visitantes[$j], "gv" => "" ];
                //$partido = new Partido($j+1, $this->equipos->getByProperty("nombre", $locales[$j]),"",$this->equipos->getByProperty("nombre", $visitantes[$j]),""); 
                //$miJornada->getPartidos()->add($partido);
            }
            $miJornada->creaPartidos($partidosIda, $this->equipos,$dbh);          
            $this->jornadas->add($miJornada);
            $equipoBase = array_shift($equipos);
            array_unshift($equipos, array_pop($equipos));
            array_unshift($equipos, $equipoBase);
            unset($partidosIda);
        }
        
        foreach ($liga as $jornada) {
            $fecha = strtotime ( '+7 day' , strtotime ( $fecha ) ) ;
            $fecha = date ( 'Y-m-j' , $fecha );
            //$miJornada = new Jornada($i+=1, $fecha); 
            $miJornada =  new Jornada($fecha, $this->id);
            $miJornada->persist($dbh);
            foreach ($jornada as $partido) {
                $local = $partido['visitante'];
                $visitante = $partido['local'];
                $partidosVuelta[] = ["id" => (int)$miJornada->getId(), "local" => $visitante,"gl" => "", "visitante" => $local, "gv" => "" ];//Fallo de tipo al persistir
                //$partido = new Partido($j+=1,$this->equipos->getByProperty("nombre", $visitante),"",$this->equipos->getByProperty("nombre", $local),"");      
                //$miJornada->getPartidos()->add($partido);   
                
            }
            $miJornada->creaPartidos($partidosVuelta, $this->equipos,$dbh);          
            $this->jornadas->add($miJornada);         
            unset($partidosVuelta);
        }
        
    }
    public function generaClasificacion($dbh) {
        
        $clasificacion = [];
        while ($equipo = $this->equipos->iterate()){
            $clasificacion [$equipo->getNombre()]=['GF'=> 0 ,'GC'=> 0 ,'GA'=> 0 ,'Puntos'=> 0 ]; 
        }   
        while ($jornada = $this->jornadas->iterate()){
            $jornada->getPartidosById($jornada->getId(),$dbh);
            $clasificacionJornada = $jornada->clasificacionJornada();
            if(!is_null($clasificacionJornada)){
                foreach ($clasificacionJornada as $id => $valor) {
                    $equipo = $_SESSION['liga']->getEquipos()->getByProperty('id', $id)->getNombre();
                    $clasificacion[$equipo]['GF'] += $valor['GF'];
                    $clasificacion[$equipo]['GC'] += $valor['GC'];
                    $clasificacion[$equipo]['Puntos'] += $valor['Puntos'];
                    $clasificacion[$equipo]['GA'] = (int)$clasificacion[$equipo]['GF']- (int)$clasificacion[$equipo]['GC'];  
                }
            }
            unset($clasificacionJornada);
        }
               
        $columna_puntos = array_column($clasificacion, 'Puntos');
        $columna_average = array_column($clasificacion, 'GA');
        
        array_multisort($columna_puntos,SORT_DESC,$columna_average,SORT_DESC,$clasificacion);     
        unset($clasificacion['Descanso']);
        return $clasificacion;
    }
    
    public static function isLiga($bd){
        
        $query = "SELECT * FROM liga";
        $stmt = $bd->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,"Liga");
        $stmt->execute();
        $liga = $stmt->fetch();    
        return $liga; 
    }
    
    public function persist($bd){
        if($this->id){
            $query = "UPDATE liga SET id = :id, solucionada = :solucionada, palabra = :palabra, intentos = :intentos,".
                      " letrasUsadas = :letrasUsadas, acabada = :acabada, tamanioPalabra = :tamanioPalabra WHERE  idPartida = :idPartida";
            $stmt = $bd->prepare($query);
            $stmt->execute(array(":id" => $this->id, ":solucionada" => $this->getSolucionada(), ":palabra" =>$this->getPalabra(),":tamanioPalabra" => $this->tamanioPalabra,
                ":intentos" => $this->intentos, ":letrasUsadas" =>$this->getLetrasUsadas(), ":acabada" => $this->acabada, ":idPartida" => $this->idPartida));
        } else { 
            $query = "INSERT INTO liga (nombre) VALUES ".
                "( :nombre)";
            $stmt = $bd->prepare($query);
            $insert = $stmt->execute(array(":nombre" => $this->nombre));
            if($insert){
                $this->setId($bd->lastInsertId());
            }
        }
    }
    
     public function recuperaJornadas($dbh){
        $query = "SELECT * FROM jornada WHERE idLiga = :idLiga ";
        $stmt = $dbh->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,"Jornada");
        $stmt->execute(array(":idLiga" => $this->id));
        $jornadas = $stmt->fetchAll();
        foreach ($jornadas as $jornada) {
            $this->jornadas->add($jornada);
        }
    }
    public function recuperaEquipos($dbh){
        $query = "SELECT * FROM equipo WHERE idLiga = :idLiga ";
        $stmt = $dbh->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,"Equipo");
        $stmt->execute(array(":idLiga" => $this->id));
        $equipos = $stmt->fetchAll();
        foreach ($equipos as $equipo) {
            $this->equipos->add($equipo);
        }
    }
}
