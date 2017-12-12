<?php

class Usuario {
    private $id;
    private $nombre;
    private $pass;
    private $apuestas;
    
    function __construct($nombre = null, $pass = null, $id = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->apuestas = new Collection();
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
    function setApuestas($apuestas) {
        $this->apuestas->add($apuestas);
    }

        
    public function persist($dbh) {
        $query = "INSERT INTO usuario (nombre,pass) VALUES (:nombre,:pass)";
        $insert = $dbh->prepare($query);
        $persistido = $insert->execute(array(":nombre" => $this->nombre, ":pass" => $this->pass));
        if ($persistido) {
         
            $this->setId($dbh->lastInsertId());
        }else{
            throw new Exception;
        }
    }
    public function getByCredenciales($nombre,$pass,$dbh) {
        $query = "SELECT * FROM usuario WHERE nombre = :nombre AND pass = :pass";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usuario");
        $consulta->execute(array(":nombre" => $nombre, ":pass" => $pass));
        $usuario = $consulta->fetch();
        return $usuario;
    }

    public function getApuestas($dbh) {
        $query = "SELECT * FROM apuesta WHERE idUsuario = :idUsuario";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Apuesta");
        $consulta->execute(array(":idUsuario" => $this->id));
        $apuestas = $consulta->fetchAll();
        if($apuestas){
            foreach ($apuestas as $apuesta) {
                $this->apuestas->add($apuesta);
            }
        }
    }
    public function comprobarPremios($resultados) {
       
        foreach ($resultados as $y => $resultado) {
            $apuesta = $this->apuestas->getByProperty("idPartido", $y);
            if($apuesta){
                $premio = $apuesta->calcularPremio($resultado);
                $premios[$apuesta->getIdPartido()]= ["resultado" => $resultado['resultado'],"apuesta" => $apuesta->getResultado() ,"premio" => $premio];
            }
            
        }
        return $premios;
    }
    public function deleteApuestas($dbh) {
        $query = "DELETE FROM apuesta WHERE idUsuario = :idUsuario";
        $delete = $dbh->prepare($query);
        $delete->execute(array("idUsuario" => $this->id));    
    }

}
