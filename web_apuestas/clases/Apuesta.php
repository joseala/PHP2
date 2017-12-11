<?php


class Apuesta {
    private $id;
    private $idUsuario;
    private $idPartido;
    private $resultado;
    private $cantidad;
    private $premio;
   
    
    function __construct($idUsuario = null, $idPartido = null, $resultado = null,$cantidad = null, $id = null) {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->idPartido = $idPartido;
        $this->resultado = $resultado;
        $this->cantidad = $cantidad;
        $this->premio = 0;
    }
    function getResultado() {
        return $this->resultado;
    }

    function setResultado($resultado) {
        $this->resultado = $resultado;
    }

        function getId() {
        return $this->id;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdPartido() {
        return $this->idPartido;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    
    function setId($id) {
        $this->id = $id;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdPartido($idPartido) {
        $this->idPartido = $idPartido;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function persist($dbh) {
        $query = "INSERT INTO apuesta (idUsuario,idPartido,resultado,cantidad) VALUES (:idUsuario,:idPartido,:resultado,:cantidad)";
        $insert = $dbh->prepare($query);
        $persistido = $insert->execute(array(":idUsuario" => $this->idUsuario, ":idPartido" => $this->idPartido, ":resultado" => $this->resultado, ":cantidad" => $this->cantidad));
        if ($persistido) {         
            $this->setId($dbh->lastInsertId());
        }
    }
    public function calcularPremio($resultado) {
        if($this->resultado == $resultado['resultado']){
            $premio = $this->cantidad * (int)$resultado['ratio'];  
        }else{
             $premio = $this->cantidad * (-1);
        }
        
        return $premio;
    }


}
