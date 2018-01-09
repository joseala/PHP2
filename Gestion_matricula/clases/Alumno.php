<?php
/**
 * Description of Alumno
 *
 * @author Administrador
 */
class Alumno {
    private $id;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $edad;
    private $sexo;
    private $idGrupo;
    
    function __construct($nombre = null, $apellido1 = null, $apellido2 = null, $edad = null, $sexo = null,$idGrupo = null,$id = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->edad = $edad;
        $this->sexo = $sexo;
        $this->idGrupo = $idGrupo;
    }

    function getId() {
        return $this->id;
    }
    function getIdGrupo() {
        return $this->idGrupo;
    }

    function setIdGrupo($idGrupo) {
        $this->idGrupo = $idGrupo;
    }

        function getNombre() {
        return $this->nombre;
    }

    function getApellido1() {
        return $this->apellido1;
    }

    function getApellido2() {
        return $this->apellido2;
    }

    function getEdad() {
        return $this->edad;
    }

    function getSexo() {
        return $this->sexo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function persist($dbh) {
        $query = "INSERT INTO alumno (nombre,apellido1,apellido2,edad,sexo,idGrupo) VALUES (:nombre,:apellido1,:apellido2,:edad,:sexo,:idGrupo)";
        $insert = $dbh->prepare($query);
        $persistido = $insert->execute(array(":nombre" => $this->nombre, ":apellido1" => $this->apellido1, 
            ":apellido2" => $this->apellido2, ":edad" => $this->edad, ":sexo" => $this->sexo, ":idGrupo" => $this->idGrupo));
        if($persistido){
            $this->setId($dbh->lastInsertId());
        }      
    }
     
    public static function deleteAlumno($dbh, $id) {
        $query = "DELETE FROM alumno WHERE id = :id";
        $delete = $dbh->prepare($query);
        $delete->execute(array(":id" => $id));
    }
    public function update($dbh) {
        $query = "UPDATE alumno SET nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, edad = :edad, sexo = :sexo WHERE id = :id";
        $update = $dbh->prepare($query);
        $update->execute(array(":id" => $this->id, ":nombre" => $this->nombre, ":apellido1" => $this->apellido1, ":apellido2" => $this->apellido2,
            ":edad" => $this->edad, ":sexo" => $this->sexo));
    }
}
