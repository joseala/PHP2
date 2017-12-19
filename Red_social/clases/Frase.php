<?php

class Frase {
    private $id;
    private $idUsuario;
    private $texto;
    private $fecha;
    
    function __construct($idUsuario = null, $texto = null, $fecha = null, $id = null) {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->texto = $texto;
        $this->fecha = $fecha;
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
    
    function getFecha() {
        return $this->fecha;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function persist($dbh) {

        $query = "INSERT INTO frase (idUsuario, texto, fecha) VALUES (:idUsuario, :texto, :fecha)";
        $insert = $dbh->prepare($query);
        $persistido = $insert->execute(array(":idUsuario" => $this->idUsuario, "texto" => $this->texto, "fecha" => $this->fecha));
        if($persistido){
            $this->setId($dbh->lastInsertId());
        }     
   }
   /**
    * Recupera frases de cada usuario seguido.
    * 
    * @param PDO $dbh
    * @param Collection $seguidos
    * @return array Obj
    */
   /*public static function recuperaFrases($dbh,$seguidos) {
        $frases_seguidos = [];
        while ($seguido = $seguidos->iterate()){
            $query = "SELECT * FROM frase WHERE idUsuario = :idUsuario";
            $consulta = $dbh->prepare($query);
            $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Frase");
            $consulta->execute(array(":idUsuario" => $seguido->getId()));            
            $frases_seguidos[$seguido->getId()] = $consulta->fetchAll();
           
       }
       return $frases_seguidos;
   }*/

}
