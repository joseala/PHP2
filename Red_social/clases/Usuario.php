<?php


class Usuario {
   private $id;
   private $nombre;
   private $pass;
   private $seguidos;
   private $noSeguidos;
   private $frases;
   
   function __construct($nombre = null , $pass = null , $id = null) {
       $this->id = $id;
       $this->nombre = $nombre;
       $this->pass = $pass;
       $this->seguidos = new Collection();
       $this->noSeguidos = new Collection();
       $this->frases = new Collection();
   }
   function getId() {
       return $this->id;
   }

   function getNombre() {
       return $this->nombre;
   }

   function getPass() {
       return $this->pass;
   }

   function getSeguidos() {
       return $this->seguidos;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setNombre($nombre) {
       $this->nombre = $nombre;
   }

   function setPass($pass) {
       $this->pass = $pass;
   }

   function setSeguidos($seguidos) {
       $this->seguidos = $seguidos;
   }
   function getFrases() {
       return $this->frases;
   }

   function setFrases($frases) {
       $this->frases = $frases;
   }
   function getNoSeguidos() {
       return $this->noSeguidos;
   }

   function setNoSeguidos($noSeguidos) {
       $this->noSeguidos = $noSeguidos;
   }

      
   public function persist($dbh) {     
       $query = "INSERT INTO usuario (nombre, pass) VALUES (:nombre, :pass)";
       $insert = $dbh->prepare($query);
       $persistido = $insert->execute(array(":nombre" => $this->nombre, ":pass" => $this->pass));
       if($persistido){
           $this->setId($dbh->lastInsertId());
       }else{
           throw new Exception;
       }
       
   }
   /**
    * 
    * @param object PDO $dbh
    * @param string $nombre
    * @param string $pass
    * @return object Usuario
    */
   public static function getByCrecencial($dbh,$nombre,$pass) {
       $query = "SELECT * FROM usuario WHERE nombre = :nombre AND pass = :pass";
       $consulta = $dbh->prepare($query);
       $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usuario");
       $consulta->execute(array(":nombre" => $nombre, "pass" => $pass));
       $usuario = $consulta->fetch();
       return $usuario;
   }
   public function recuperaSeguidos($dbh) {
       $query = "SELECT * FROM seguido WHERE idSeguido = :id";
       $consulta = $dbh->prepare($query);
       $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Seguido");
       $consulta->execute(array(":id" => $this->id));
       $seguidos = $consulta->fetchAll();      
       foreach ($seguidos as $seguido) {
           $query = "SELECT * FROM usuario WHERE id = :id";
           $consulta = $dbh->prepare($query);
           $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usuario");
           $consulta->execute(array(":id" => $seguido->getIdUsuario()));
           $usuario = $consulta->fetch();
           $this->seguidos->add($usuario);
       }
   }
   public function recuperaNoSeguidos($dbh) {
       
       if($this->seguidos->isEmpty()){
          $query = "SELECT * FROM usuario WHERE id <> :idUsuario ";
            $consulta = $dbh->prepare($query);
            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usuario");
            $consulta->execute(array(":idUsuario" => $this->id));
            $noSeguidos = $consulta->fetchAll();
            foreach ($noSeguidos as $noSeguido) {
                $this->noSeguidos->add($noSeguido);
            }  
       }else{
            $query = "SELECT * FROM usuario";
            $consulta = $dbh->prepare($query);
            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usuario");
            $consulta->execute();
            $usuarios = $consulta->fetchAll();
            foreach ($usuarios as $usuario) {
                if(!$this->seguidos->getByProperty("id", $usuario->getId())){
                    if($this->id != $usuario->getId() ){
                        $this->noSeguidos->add($usuario);
                    }
                    
                }              
            }
            
       }
      
   }
   public function recuperaFrases($dbh) {
       while($seguido = $this->seguidos->iterate()){
            $query = "SELECT * FROM frase WHERE idUsuario = :id";
            $consulta = $dbh->prepare($query);
            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Frase");
            $consulta->execute(array(":id" => $seguido->getId()));
            $frases = $consulta->fetchAll();
            $tamanio = count($frases);
            if($tamanio != 0){
                $this->frases->add($frases[$tamanio-1]); 
            }
            
       }
   }
   public function crearXML($frases) {
       
$xml = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<RedSocial></RedSocial>
XML;
        $redSocial = new SimpleXMLElement($xml);
        
        foreach ($frases as $y => $frase) {
            $usuario = $redSocial->addChild("Usuario");
            $usuario->addAttribute("id", $y);
            foreach (  $frase as $y => $texto) {
               $fra = $usuario->addChild("frase", $texto->getTexto());
               $fra->addAttribute("id", $texto->getTexto());
            }
            
        }   
        $archivo = $redSocial->asXML();
        $fichero = fopen("xml/archivo.xml", "w+");
        fwrite($fichero, $archivo);
        
   }
}
