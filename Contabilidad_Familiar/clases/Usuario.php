<?php
/**
 * Description of Usuario
 *
 * @author Administrador
 */
class Usuario {
    private $id;
    private $nombre;
    private $pass;
    private $apuntes;
    
    function __construct($nombre = null, $pass = null, $id = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->apuntes = new Collection();
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

    function getApuntes() {
        return $this->apuntes;
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

    function setApuntes($apuntes) {
        $this->apuntes = $apuntes;
    }

    public function persist($dbh) {
       
        $query = "INSERT INTO usuario (nombre,pass) VALUES (:nombre,:pass)";
        $insert = $dbh->prepare($query);
        $insertado = $insert->execute(array(":nombre" => $this->nombre, ":pass" => $this->pass));
        if($insertado){
            $this->setId($dbh->lastInsertId());
        }else{
            throw new Exception;
        }
    }
    
    public static function getByCredenciales($dbh,$nombre,$pass) {
        $query = "SELECT * FROM usuario WHERE nombre = :nombre AND pass = :pass";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usuario");
        $consulta->execute(array(":nombre" => $nombre, ":pass" => $pass));
        $usuario = $consulta->fetch();
        return $usuario;
    }
    
    public function getApuntesByCredenciales($dbh) {
        $query = "SELECT * FROM apunte WHERE idUsuario = :idUsuario";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Apunte");
        $consulta->execute(array(":idUsuario" => $this->id));
        $apuntes = $consulta->fetchAll();
        foreach ($apuntes as $apunte) {
            $this->apuntes->add($apunte);
        }
    }
    
    public function getTotal() {
            $total = 0;
        while ($apunte = $this->getApuntes()->iterate()){
            $total += $apunte->getCantidad();
        }
        return $total;
    }
}
