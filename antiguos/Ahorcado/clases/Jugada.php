<?php

class Jugada {
   
    private $idJugada;
    private $letra;
    private $solucionada;

    public function __construct($letra = null) {
        $this->letra = $letra;
    }
    function getIdJugada() {
        return $this->idJugada;
    }
    function getSolucionada() {
        return $this->solucionada;
    }

    function setIdJugada($idJugada) {
        $this->idJugada = $idJugada;
    }
    function setSolucionada($solucionada) {
        $this->solucionada = $solucionada;
    }
    function getLetra() {
        return $this->letra;
    }

    function setLetra($letra) {
        $this->letra = $letra;
    }
    //Recupera jugadas de la partida
    public static function getJugadasByIdPartida($bd,$idPartida){
        $query = "SELECT * FROM jugada WHERE idPartida = :idPartida";
        $stmt = $bd->prepare($query);
        $stmt ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Jugada");
        $stmt->execute(array(":idPartida" => $idPartida));
        $misJugadas = $stmt->fetchAll();
        return $misJugadas;
    }
    public function persist($bd,$idPartida){
        $query = "INSERT INTO jugada (idPartida, solucionada, letra) VALUES (:idPartida, :solucionada, :letra)";
        $stmt = $bd->prepare($query);
        $insert = $stmt->execute(array(":idPartida" => $idPartida, ":solucionada" => $this->solucionada,
            ":letra" => $this->letra));
        if($insert){
            $this->idJugada = $bd->lastInsertId();
        }
    }
    public function delete($bd,$idPartida){
        $query = "DELETE FROM jugada WHERE idPartida = :idPartida";
        $stmt = $bd->prepare($query);
        $stmt->execute(array(":idPartida" => $idPartida));
    }
    

}
