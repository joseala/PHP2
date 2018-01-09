<?php
/**
 * Description of Admin
 *
 * @author Administrador
 */
class Admin {
    private $id;
    private $nombre;
    private $pass;
    
    function __construct($id= null, $nombre = null, $pass = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pass = $pass;
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

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    public static function getByCredencial($dbh,$nombre,$pass) {
        $query = "SELECT * FROM admin WHERE nombre = :nombre AND pass = :pass";
        $consulta = $dbh->prepare($query);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Admin");
        $consulta->execute(array(":nombre" => $nombre, ":pass" => $pass));
        $admin = $consulta->fetch();
        if($admin){
            return $admin;
        }else{
            throw new Exception; 
        }
    }
}
