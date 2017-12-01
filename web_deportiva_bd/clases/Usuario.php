<?php


class Usuario {
    private $nombre;
    private $pass;
    private $id;
   
            
    function __construct($nombre= null, $pass = null){
       $this->nombre = $nombre;
       $this->pass = $pass;
       
    }
    function getNombre(){
        return $this->nombre;
    }
    function getPassword(){
        return $this->pass;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPassword($password) {
        $this->pass = $password;
    }
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    function getPass() {
        return $this->pass;
    }
    function setPass($pass) {
        $this->pass = $pass;
    }

    
    public function getByCredencial($dbh,$nom,$password){
        $select="SELECT * FROM usuario WHERE nombre= :nombre AND pass= :pass";
        $consulta = $dbh->prepare($select);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,"Usuario");
        $consulta->execute(array(":nombre" => $nom, ":pass" => $password ));
        $logueado = $consulta->fetch();
        /*if($logueado){                   
            $calendario = Calendario::getCalendarios($dbh, $logueado->getId());
            foreach ($calendario as $miCalendario){
                $this->calendario->add($calendario);
            }

        }*/
        return $logueado;
    }
    public function persist($dbh){
        if($this->id){
            $modificar = "UPDATE usuario SET nombre= :nombre ,pass= :pass WHERE id= :id";
            $persistir = $dbh->prepare($modificar);
            $persistido = $persistir->execute(array(":nombre" => $this->nombre,":pass" => $this->pass, ":id" => $this->id)); 
        }else{            
            $insertar = "INSERT into usuario (nombre,pass) values (:nombre, :pass)";
            $persistir = $dbh->prepare($insertar);
            $persistido = $persistir->execute(array(":nombre" => $this->nombre,":pass" => $this->pass));    
            if($persistido){
                $this->setId($dbh->lastInsertId());
            }
        }
        return $persistido;
    }
   
}     
