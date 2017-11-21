<?php
require_once 'BD.php';
require_once 'Jugada.php';
require_once 'Collection.php';
require_once 'Palabras.php';
class Partida {
    private $idPartida;
    private $intentos;
    private $palabra;
    private $letrasUsadas;
    private $solucionada ;
    private $acabada;
    private $perdida;
    private $jugadas;
    const PIERDE = 6;
    

    public function __construct($palabra=null,$tamanio=null,$acabada = null,$intentos=null,$solucionada = null, $idPartida= null, $letrasUsadas = null)
    {
        $this->acabada = false;
        $this->letrasUsadas = "";
        $palabras = Palabras::getInstance();
        $this->palabra = $palabras->getPalabra();
        $this->solucionada = implode("",array_fill(0,strlen($this->palabra),"_"));    
        $this->intentos = 0; 
        $this->perdida = false;
        $this->jugadas = new Collection();
        
    }
    function getPerdida() {
        return $this->perdida;
    }

    function setPerdida($perdida) {
        $this->perdida = $perdida;
    }

        function getIdPartida() {
        return $this->idPartida;
    }

    function setIdPartida($idPartida) {
        $this->idPartida = $idPartida;
    }

    function getIntentos() {
        return $this->intentos;
    }

    function getPalabra() {
        return $this->palabra;
    }
    function getIdUsuario() {
        return $this->id;
    }

    function getSolucionada() {
        return $this->solucionada;
    }
    function getLetrasUsadas() {
        return $this->letrasUsadas;
    }
    function setIdUsuario($idUsuario) {
        $this->id = $idUsuario;
    }

    function setSolucionada($solucionada) {
        $this->solucionada = $solucionada;
    }
    function setIntentos($intentos) {
        $this->intentos = $intentos;
    }

    function setPalabra($palabra) {
        $this->palabra = $palabra;
    }

    function setLetrasUsadas($letra) {
        $this->letrasUsadas =$this->letrasUsadas.$letra;
    }
   
    function getAcabada(){
        return $this->acabada;    
    }
    function getJugadas() {
        return $this->jugadas;
    }

    function setJugadas($jugadas) {
        $this->jugadas = $jugadas;
    }
    //Comprueba si letra existe en palabra oculta
    //Recibe letra elegida y devuelve array con letras acertadas en su posicion original.
    function compruebaJugada($dbh,$jugada){ 
        $arrayElegida = str_split($this->palabra);
        $acierto = false;
        $letra = $jugada->getLetra();
        Partida::setLetrasUsadas($letra);
        $encontradas = array_map(function($l)use($letra,&$acierto){
            if($l === $letra){
                $valor = $letra;
                $acierto = true;
            }else{
                $valor = "_";
            }               
            return $valor;
        } ,$arrayElegida);
        if(!$acierto){
            $this->intentos++;
            if($this->intentos >= self::PIERDE){
                $this->perdida = true;
            }
        }
        $x=0;
        $solucionada = str_split($this->solucionada);
        foreach ($encontradas as $key => $value) {
            if($solucionada[$key] == "_"){
                $solucionada[$key]=$value;
                if($value != "_"){
                    $x++;
                }
            }else{
                $x++;
            }
        }
        $this->solucionada = implode("",$solucionada);
        if($x == strlen($this->palabra)){
            $this->acabada = true;
        }
        $jugada->setSolucionada($this->solucionada);  
        $jugada->persist($dbh, $this->idPartida);
        return $this->acabada;
    }
    //Recupera todas la partidas del usuario logueado
    public static function getPartidasByIdUser($bd, $id){
        $query = "SELECT * FROM partida WHERE id = :id";
        $stmt = $bd->prepare($query);
        $stmt ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Partida");
        $stmt->execute(array(":id" => $id));
        $miPartidas = $stmt->fetchAll();
        return $miPartidas;
    }
    //Recupera las partidas elegida no finalizada
    public static function getByIdPartida($bd,$idPartida){
        $query = "SELECT * FROM partida WHERE idPartida = :id";
        $stmt = $bd->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Partida");
        $stmt->execute(array(":id" => $idPartida));
        $partida = $stmt->fetch();
        if($partida){
            //Recupera todas las partidas de la base de datos mediante el ID
            $jugadas = Jugada::getJugadasByIdPartida($bd, $idPartida);
            foreach ($jugadas as $jugada){
                //Añade partidas a la coleccion del usuario.
                $partida->jugadas->add($jugada);
            }

        }
        return $partida;
    }
    public function persist($bd,$id){
        if($this->getIdPartida()){
            $query = "UPDATE partida SET id = :id, solucionada = :solucionada, palabra = :palabra, intentos = :intentos,".
                      " letrasUsadas = :letrasUsadas, acabada = :acabada WHERE  idPartida = :idPartida";
            $stmt = $bd->prepare($query);
            $stmt->execute(array(":id" => $id, ":solucionada" => $this->getSolucionada(), ":palabra" =>$this->getPalabra(),
                ":intentos" => $this->intentos, ":letrasUsadas" =>$this->getLetrasUsadas(), ":acabada" => $this->acabada, ":idPartida" => $this->idPartida));
        } else {
            
            $query = "INSERT INTO partida (id, solucionada, palabra, intentos, letrasUsadas, acabada) VALUES ".
                "(:id, :solucionada, :palabra, :intentos, :letrasUsadas, :acabada)";
            $stmt = $bd->prepare($query);
            $insert = $stmt->execute(array(":id" => $id, ":solucionada" => $this->getSolucionada(), ":palabra" => $this->getPalabra(),
                ":intentos" => $this->getIntentos(), ":letrasUsadas" => $this->getLetrasUsadas(), ":acabada" => $this->getAcabada()));
            if($insert){
                $this->setIdPartida($bd->lastInsertId());
            }
        }
    }
    public function crearXml($idPartida){
        $pruebaXml = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<IdPartida></IdPartida>
XML;
$miPartida = new SimpleXMLElement($pruebaXml);//Crea un nuevo objeto SimpleXMLElement
        $miPartida->addAttribute('id', $idPartida);//Añade un elemento hijo al nodo XML
        
        
        while( $jugada = $this->jugadas->iterate()){
            $jugadas = $miPartida->addChild('Jugada');
            $jugadas->addAttribute('id',$jugada->getIdJugada());
            $acierto = $jugadas->addChild('PalabraEncontrada', $jugada->getSolucionada());
            $acierto = $jugadas->addChild('Letra',$jugada->getLetra());
        }
        $miFichero = $miPartida->asXML();//Retorna un string XML correcto basado en un elemento SimpleXML
        $miArchivo = fopen("xml/miPartida.xml", "w+");//Abre un fichero o un URL
        fwrite($miArchivo, $miFichero);//Escritura archivo
    }
    public function delete($bd,$idPartida){
        $query = "DELETE FROM partida WHERE idPartida = :idPartida";
        $stmt = $bd->prepare($query);
        $stmt->execute(array(":idPartida" => $idPartida));
    }
    
}
