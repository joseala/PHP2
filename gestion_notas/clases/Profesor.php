<?php

class Profesor {
    private $id;
    private $nombre;
    private $pass;
    private $alumnos;
    private $asignaturas;
    
    function __construct($nombre = null, $pass = null,$id = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->alumnos = new Collection();
        $this->asignaturas = new Collection();
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPass() {
        return $this->pass;
    }

    function getAlumnos() {
        return $this->alumnos;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setAlumnos($alumnos) {
        $this->alumnos = $alumnos;
    }
    function getAsignaturas() {
        return $this->asignaturas;
    }

    function setAsignaturas($asignaturas) {
        $this->asignaturas = $asignaturas;
    }

        public function getCredenciales($dbh) {
        $query = "SELECT * FROM profesor WHERE nombre = :nombre AND pass = :pass";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Profesor");
        $consulta->execute(array(":nombre" => $this->nombre, ":pass" => $this->pass));
        $profesor = $consulta->fetch();
        if($profesor){
            $this->setId($profesor->getId());
            $alumnos = Alumno::getAlumnos($dbh, $this->id);
            foreach ($alumnos as $alumno) {
                $this->alumnos->add($alumno);
            }
            $asignaturas = Asignatura::getAsignaturas($dbh);
            foreach ($asignaturas as $asignatura) {
                $this->asignaturas->add($asignatura);
            }
            $logueado = true;
        }else{
            $logueado = false;
        }
        return $logueado;
    }
    
    public function guardaNotas($dbh,$notas) {
        
        foreach ($notas as $idAlumno => $nota) {
            $alumno = $this->alumnos->getByProperty("id", $idAlumno);           
            foreach ($nota as $idAsignatura => $valor) {
                $query = "INSERT INTO nota (idAlumno,idAsignatura,nota) VALUES (:idAlumno,:idAsignatura,:nota)";
                $insert = $dbh->prepare($query);
                $insert->execute(array(":idAlumno" => $idAlumno, ":idAsignatura" => $idAsignatura, ":nota" => $valor));
                $alumno->setNotas(new Nota($idAlumno, $idAsignatura, $valor));
            }
        }              
    }
    public function crearXML($dbh) {
    
$xml = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<Profesor></Profesor>
XML;
        $profesor = new SimpleXMLElement($xml);
        $profesor->addAttribute("id", $_SESSION['profesor']->getId());
        while ($alumnoActual = $this->getAlumnos()->iterate()){
            $alumno = $profesor->addChild("Alumno");
            $alumno->addAttribute("nombre", $alumnoActual->getNombre());
            while ($notaActual = $alumnoActual->getNotas()->iterate()){
               $nota = $alumno->addChild("Nota", $notaActual->getNota());
               $nota->addAttribute("Asignatura", $_SESSION['profesor']->getAsignaturas()->getByProperty("id", $notaActual->getIdAsignatura())->getNombre());
            }            
        }
        
        $archivo = $profesor->asXML();
        $fichero = fopen("xml/archivo.xml", "w+");
        fwrite($fichero, $archivo);
    }

}
