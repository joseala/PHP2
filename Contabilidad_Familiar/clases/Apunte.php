<?php
/**
 * Description of Apunte
 *
 * @author Administrador
 */
class Apunte {
    private $id;
    private $idUsuario;
    private $tipo;
    private $concepto;
    private $cantidad;
    private $fecha;
    
    function __construct($idUsuario = null, $tipo = null, $concepto = null, $cantidad = null, $fecha = null, $id = null) {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->tipo = $tipo;
        $this->concepto = $concepto;
        $this->cantidad = $cantidad;
        $this->fecha = $fecha;
    }
    
    function getId() {
        return $this->id;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getConcepto() {
        return $this->concepto;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setConcepto($concepto) {
        $this->concepto = $concepto;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function persist($dbh) {
        $query = "INSERT INTO apunte (idUsuario,tipo,concepto,cantidad,fecha) VALUES (:idUsuario,:tipo,:concepto,:cantidad,:fecha)";
        $insert = $dbh->prepare($query);
        $insertado = $insert->execute(array(":idUsuario" => $this->idUsuario, ":tipo" => $this->tipo, "concepto" => $this->concepto,
            "cantidad" => $this->cantidad, "fecha" => $this->fecha));
        if($insertado){
            $this->setId($dbh->lastInsertId());
        }
    }
    
    public static function getFiltrado($dbh,$idUsuario,$desde,$hasta) {
        
        $query = "SELECT * FROM apunte WHERE idUsuario = :idUsuario AND fecha >= :desde AND fecha <= :hasta";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute(array(":idUsuario" => $idUsuario, ":desde" =>$desde, ":hasta" => $hasta));
        $apuntes = $consulta->fetchAll();
        return $apuntes;
    }
    
    public static function getFiltradoTodo($dbh,$idUsuario,$desde,$hasta,$tipo) {
        
        $query = "SELECT * FROM apunte WHERE idUsuario = :idUsuario AND tipo = :tipo AND fecha >= :desde AND fecha <= :hasta";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute(array(":idUsuario" => $idUsuario, ":desde" =>$desde, ":hasta" => $hasta, "tipo" => $tipo));
        $apuntes = $consulta->fetchAll();
        return $apuntes;
    }
    
    public static function getFiltradoTipo($dbh,$idUsuario,$tipo) {
        
        $query = "SELECT * FROM apunte WHERE idUsuario = :idUsuario AND tipo = :tipo";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute(array(":idUsuario" => $idUsuario, ":tipo" =>$tipo));
        $apuntes = $consulta->fetchAll();
        return $apuntes;
    }
}