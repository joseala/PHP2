<?php


class Linea {
    private $id;
    private $idProducto;
    private $idCarro;
    private $cantidad;
    
    function __construct($idProducto = null, $cantidad = null, $idCarro = null, $id = null) {
        $this->id = $id;
        $this->idProducto = $idProducto;
        $this->cantidad = $cantidad;
        $this->idCarro = $idCarro;
    }
    function getIdCarro() {
        return $this->idCarro;
    }

    function setIdCarro($idCarro) {
        $this->idCarro = $idCarro;
    }

    function getId() {
        return $this->id;
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function persist($dbh) {
        $query = "INSERT INTO linea (idProducto, idcarro, cantidad) VALUES (:idProducto, :idCarro, :cantidad)";
        $persiste = $dbh->prepare($query);
        $persistido = $persiste->execute(array(":idProducto" => $this->idProducto, ":cantidad" => $this->cantidad,":idCarro" => $this->idCarro ));
        if($persistido){
            $this->setId($dbh->lastInsertId());
        }
    }
    public function getLinea($dbh, $id){
        $query = "SELECT * FROM linea WHERE id = :id";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Linea");
        $consulta->execute(array(":id" => $id));
        $linea = $consulta->fetch();
        return $linea;
    }
    
    public function delete($dbh) {
        
    }

}
