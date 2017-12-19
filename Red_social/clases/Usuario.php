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
    * Recupera usuario de BBDD si las
    * credenciales son correctas.
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
   /**
    * Recupera seguidos por usuario.
    * 
    * @param PDO $dbh
    */
   public function recuperaSeguidos($dbh) {
       $query = "SELECT idUsuario FROM seguido WHERE idSeguido = :id";
       $consulta = $dbh->prepare($query);
       $consulta->setFetchMode(PDO::FETCH_ASSOC);
       //$consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Seguido");
       $consulta->execute(array(":id" => $this->id));
       $seguidos = $consulta->fetchAll();      
       foreach ($seguidos as $seguido) {
           $query = "SELECT * FROM usuario WHERE id = :id";
           $consulta = $dbh->prepare($query);
           $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usuario");
           $consulta->execute(array(":id" => $seguido['idUsuario']));
           $usuario = $consulta->fetch();
           $usuario->recuperaFrases($dbh);
           $this->seguidos->add($usuario);
       }
   }
   /**
    * Si no hay seguidos, añade a la coleccion noSeguidos
    * todos los usuarios de la BBDD menos el actual.
    * Si hay seguidos, añade a la coleccion noSeguidos todos 
    * los usuarios que no coincidan con el actual ni con usuarios
    * seguidos.
    * 
    * @param PDO $dbh
    */
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
   /**
    * Recupera todas las frases del usuario
    * y las añade a su coleccion de frases.
    * 
    * @param PDO $dbh
    */
   public function recuperaFrases($dbh) {
      
        $query = "SELECT * FROM frase WHERE idUsuario = :id";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Frase");
        $consulta->execute(array(":id" => $this->id));
        $frases = $consulta->fetchAll();
        //Ordenar frase por fecha
        foreach ($frases as $frase) {       
           $this->frases->add($frase); 
        }   
   }
   
   /**
    * Crea archivo XML con todos los 
    * usuarios seguidos y sus frases.
    *
    * @param array Obj $frases
    */
   public function crearXML() {
       
$xml = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<RedSocial></RedSocial>
XML;
        $redSocial = new SimpleXMLElement($xml);
        $redSocial->addAttribute("Propietario", $_SESSION['usuario']->getNombre());
        while ($usuarioActual = $_SESSION['usuario']->getSeguidos()->iterate()){
            $usuario = $redSocial->addChild("Seguido");
            $usuario->addAttribute("Nombre", $usuarioActual->getNombre());
            while($frase = $usuarioActual->getFrases()->iterate()){
                $usuario->addChild("Frase", $frase->getTexto());
            }
                
        }
        
        $archivo = $redSocial->asXML();
        $fichero = fopen("xml/archivo.xml", "w+");
        fwrite($fichero, $archivo);
        
   }
   
   public function persistSeguido($dbh,$idUsuario, $idSeguido) {
       
       $query = "INSERT INTO seguido (idUsuario, idSeguido) VALUES (:idUsuario, :idSeguido)";
       $insert = $dbh->prepare($query);
       $insert->execute(array(":idUsuario" => $idUsuario, "idSeguido" => $idSeguido));
       
   }
}
