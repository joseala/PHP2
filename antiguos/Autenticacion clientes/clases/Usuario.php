<?php

/**
 * Description of Ususario
 *
 * @author JD
 */
class Usuario {
    private $usuario;
    private $password;
    private $correo;
    private $pintor;
    private $id;
            
    function __construct($user = null,$pass= null,$correo= null,$pintor= null){
       if ($this->user !== null) { $this->usuario = $user;}
        $this->password = $pass;
        $this->correo = $correo;
        $this->pintor = $pintor;
    }
    function getUsuario(){
        return $this->usuario;
    }
    function getPassword(){
        return $this->password;
    }
    function getCorreo(){
        return $this->correo;
    }
    function getPintor(){
        return $this->pintor;
    }
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setPintor($pintor) {
        $this->pintor = $pintor;
    }
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    
    public function getByCredencial($dbh,$user,$pass){
        $select="SELECT * FROM credenciales WHERE usuario= :user AND password= :pass";
        $consulta = $dbh->prepare($select);
        $consulta->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,"Usuario");
        $consulta->execute(array(":user" => $user, ":pass" => $pass ));
        $logueado = $consulta->fetch();
        return $logueado;
    }
    public function persist($dbh){
        if($this->id){
            $modificar = "UPDATE credenciales SET usuario= :usuario ,password= :password,correo= :correo ,pintor= :pintor WHERE id= :id";
            $persistir = $dbh->prepare($modificar);
            $persistido = $persistir->execute(array(":usuario" => $this->usuario,":password" => $this->password,":correo" => $this->correo,":pintor" => $this->pintor, ":id" => $this->id)); 
        }else{            
            $insertar = "INSERT into credenciales (usuario,password,correo,pintor) values (:usuario, :password, :correo, :pintor)";
            $persistir = $dbh->prepare($insertar);
            $persistido = $persistir->execute(array(":usuario" => $this->usuario,":password" => $this->password,":correo" => $this->correo,":pintor" => $this->pintor));    
            if($persistido){
                $this->setId($dbh->lastInsertId());
            }
        }
        return $persistido;
    }
    public function delete($dbh){
        $borrar = "DELETE FROM credenciales WHERE id= :id";
        $eliminar = $dbh->prepare($borrar);
        $eliminar->execute(array(":id" => $this->id));
    }
}     