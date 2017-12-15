<?php

class Seguido {
    private $id;
    private $idUsuario;
    private $idSeguido;
    
    function __construct($idUsuario = null, $idSeguido = null, $id = null) {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->idSeguido = $idSeguido;
    }
    
    function getId() {
        return $this->id;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdSeguido() {
        return $this->idSeguido;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdSeguido($idSeguido) {
        $this->idSeguido = $idSeguido;
    }


    public function persist($dbh) {
       
       $query = "INSERT INTO seguido (idUsuario, idSeguido) VALUES (:idUsuario, :idSeguido)";
       $insert = $dbh->prepare($query);
       $persistido = $insert->execute(array(":idUsuario" => $this->idUsuario, "idSeguido" => $this->idSeguido));
       if($persistido){
           $this->setId($dbh->lastInsertId());
       }else{
           throw new Exception;
       }
       
   }

}
