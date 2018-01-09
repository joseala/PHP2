<?php
/**
 * Description of Grupo
 *
 * @author Administrador
 */
class Grupo {
    private $id;
    private $nombre;
    private $idioma;
    private $alumnos;
    
    function __construct($id = null, $nombre = null, $idioma = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->idioma = $idioma;
        $this->alumnos = new Collection();
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getIdioma() {
        return $this->idioma;
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

    function setIdioma($idioma) {
        $this->idioma = $idioma;
    }

    function setAlumnos($alumnos) {
        $this->alumnos = $alumnos;
    }

    public static function getGrupos($dbh) {
        $query = "SELECT * FROM grupo";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Grupo");
        $consulta->execute();
        $grupos = $consulta->fetchAll();
        
        return $grupos;
       
    }
    
    public function getAlumnosByIdGrupo($dbh) {
        $query = "SELECT * FROM alumno WHERE idGrupo = :idGrupo";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Alumno");
        $consulta->execute(array(":idGrupo" => $this->id));
        $alumnos = $consulta->fetchAll();
        foreach ($alumnos as $alumno) {
            $this->getAlumnos()->add($alumno);
        }
    }
    
    public function doXmlFile($dbh) {       

$xml = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<Grupo></Grupo>
XML;
        $grupoXml = new SimpleXMLElement($xml);
        $grupoXml->addAttribute("id", $this->id);
        $grupoXml->addChild("NombreCurso", $this->nombre);
        while ( $alumno = $this->getAlumnos()->iterate()){
            $alumnoActual = $grupoXml->addChild("Alumno");
            $alumnoActual->addAttribute("id", $alumno->getid());
            $alumnoActual->addChild("Nombre", $alumno->getNombre());
            $alumnoActual->addChild("Apellido1", $alumno->getApellido1());
            $alumnoActual->addChild("Apellido2", $alumno->getApellido2());
            $alumnoActual->addChild("Edad", $alumno->getEdad());
            $alumnoActual->addChild("Sexo", $alumno->getSexo());          
        }
        $file = $grupoXml->asXML();
        $ruta = fopen("xml/fichero.xml", "w+");
        
        fwrite($ruta, $file);
    }
}
