<?php

class Frase {
    private $id;
    private $idUsuario;
    private $texto;
    
    function __construct($idUsuario = null, $texto = null, $id = null) {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->texto = $texto;
    }
    
    function getId() {
        return $this->id;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getTexto() {
        return $this->texto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    public function persist($dbh) {
       
       $query = "INSERT INTO frase (idUsuario, texto) VALUES (:idUsuario, :texto)";
       $insert = $dbh->prepare($query);
       $persistido = $insert->execute(array(":idUsuario" => $this->idUsuario, "texto" => $this->texto));
       if($persistido){
           $this->setId($dbh->lastInsertId());
       }
       
   }
   public static function recuperaFrases($dbh,$seguidos) {
        $frases_seguidos = [];
        while ($seguido = $seguidos->iterate()){
            $query = "SELECT * FROM frase WHERE idUsuario = :idUsuario";
            $consulta = $dbh->prepare($query);
            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Frase");
            $consulta->execute(array(":idUsuario" => $seguido->getId()));            
            $frases_seguidos[$seguido->getId()] = $consulta->fetchAll();
           
       }
       return $frases_seguidos;
   }

}
