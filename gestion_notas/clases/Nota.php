<?php


class Nota {
    private $idAlumno;
    private $idAsignatura;
    private $nota;
    
    function __construct($idAlumno, $idAsignatura, $nota) {
        $this->idAlumno = $idAlumno;
        $this->idAsignatura = $idAsignatura;
        $this->nota = $nota;
    }
    
    function getIdAlumno() {
        return $this->idAlumno;
    }

    function getIdAsignatura() {
        return $this->idAsignatura;
    }

    function getNota() {
        return $this->nota;
    }

    function setIdAlumno($idAlumno) {
        $this->idAlumno = $idAlumno;
    }

    function setIdAsignatura($idAsignatura) {
        $this->idAsignatura = $idAsignatura;
    }

    function setNota($nota) {
        $this->nota = $nota;
    }



}
