<?php

class Usuario {
    private $id;
    private $nombre;
    private $pass;
    
    function __construct($nombre = null, $pass = null, $id = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pass = $pass;
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



}
