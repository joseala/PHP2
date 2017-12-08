<?php

class Usuario {
    
    private $id;
    private $nombre;
    private $pass;
    private $correo;
    
    function __construct($nombre=null, $pass=null, $correo =null, $id=null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->correo = $correo;
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

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }
    function getCorreo() {
        return $this->correo;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getCredenciales($nombre,$pass,$dbh) {
        $query = "SELECT * FROM usuario WHERE nombre = :nombre AND pass = :pass";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usuario");
        $consulta->execute(array(":nombre" => $nombre, ":pass" => $pass));
        $logueado = $consulta->fetch();
        return $logueado;
    }
    public function persist($dbh) {
        
        $query = "INSERT INTO usuario (nombre,pass,correo) VALUES (:nombre,:pass,:correo)";
        $persistir = $dbh->prepare($query);
        $persistido = $persistir->execute(array(":nombre" => $this->nombre, ":pass" => $this->pass, ":correo" => $this->correo));
        if($persistido){
            $this->setId($dbh->lastInsertId());
        }else{
            throw new Exception;
        }
    }
    public function crearCarro($dbh) {       
        $carro = new Carro($this->id, date("Y-m-d"));
        $carro->persist($dbh);   
    }
    public function getCarro($dbh) {
        
        $query = "SELECT * FROM carro WHERE idUsuario = :idUsuario";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Carro");
        $consulta->execute(array(":idUsuario" => $this->id ));
        $carro = $consulta->fetch();
        return $carro;
    }
}
