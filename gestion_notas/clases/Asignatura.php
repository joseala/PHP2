<?php


class Asignatura {
    private $id;
    private $nombre;
    
    function __construct($id = null, $nombre = null) {
        $this->id = $id;
        $this->nombre = $nombre;
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public static function getAsignaturas($dbh) {
        $query = "SELECT * FROM asignatura";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Asignatura");
        $consulta->execute(array());
        $asignaturas = $consulta->fetchAll();
        return $asignaturas;
    }

}
