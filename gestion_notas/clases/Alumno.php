<?php


class Alumno {
    private $id;
    private $idProfesor;
    private $nombre;
    private $notas;
    
    function __construct($id = null, $idProfesor = null, $nombre = null) {
        $this->id = $id;
        $this->idProfesor = $idProfesor;
        $this->nombre = $nombre;
        $this->notas = new Collection();
    }
    
    function getNotas() {
        return $this->notas;
    }

    function setNotas($nota) {
        $this->notas->add($nota);
    }

        function getId() {
        return $this->id;
    }

    function getIdProfesor() {
        return $this->idProfesor;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdProfesor($idProfesor) {
        $this->idProfesor = $idProfesor;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public static function getAlumnos($dbh,$idProfesor) {
        $query = "SELECT * FROM alumno WHERE idProfesor = :idProfesor";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Alumno");
        $consulta->execute(array(":idProfesor" => $idProfesor));
        $alumnos = $consulta->fetchAll();
        return $alumnos;
    }
}
