<?php
require_once 'clases/Partida.php';
require_once 'clases/Collection.php';
class Usuario {
    private $nombre;
    private $pass;
    private $id;
    private $partidas;
            
    function __construct($nombre= null, $pass = null){
       $this->nombre = $nombre;
        $this->pass = $pass;
        $this->partidas = new Collection();
    }
    function getNombre(){
        return $this->nombre;
    }
    function getPassword(){
        return $this->pass;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPassword($password) {
        $this->pass = $password;
    }
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    function getPass() {
        return $this->pass;
    }

    function getPartidas() {
        return $this->partidas;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setPartidas($partidas) {
        $this->partidas = $partidas;
    }
    
    public static function getByCredencial($dbh,$nom,$password){
        $select="SELECT * FROM usuario WHERE nombre= :nombre AND pass= :pass";
        $stmt = $dbh->prepare($select);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,"Usuario");
        $stmt->execute(array(":nombre" => $nom, ":pass" => $password ));
        $usuario = $stmt->fetch();
        if($usuario){
            //Recupera todas las partidas de la base de datos mediante el ID
            $partidas = Partida::getPartidasByIdUser($dbh, $usuario->getId());
            foreach ($partidas as $miPartida){
                //Añade partidas a la coleccion del usuario.
                $usuario->partidas->add($miPartida);
            }

        }
        return $usuario;
    }
    public function persist($dbh){                    
        $insertar = "INSERT into usuario (nombre,pass) values (:nombre, :pass)";
        $stmt = $dbh->prepare($insertar);
        $persistido = $stmt->execute(array(":nombre" => $this->nombre,":pass" => $this->pass));    
        if($persistido){
            $this->setId($dbh->lastInsertId());
        }else{
            throw new Exception;
        }
    }
   
}     