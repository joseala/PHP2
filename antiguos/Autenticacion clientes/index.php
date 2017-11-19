<?php
require_once 'clases/BD.php';
require_once 'clases/Usuario.php';
session_start(); 

if(empty($_POST)){
    $mensaje = "Introduce Datos";
    include 'vistas/formulario.php';
}elseif(isset($_POST['enviar'])){  
    $dbh=BD::getConexion();    
    $logueado=Usuario::getByCredencial($dbh,$_POST['user'],$_POST['pass']); 
    if($logueado){       
        $_SESSION['usuario'] = $logueado;
        include 'vistas/cuadro.php';
    }else{
        $mensaje = "Usuario no encontrado";
        include 'vistas/formulario.php';
    }
}elseif(isset ($_POST['registro'])){
    include 'vistas/registro.php';       
}elseif(isset ($_POST['registrarse'])){
    $user= htmlspecialchars($_POST['usuario']);
    $pass= htmlspecialchars($_POST['password']);
    $correo= htmlspecialchars($_POST['correo']);
    $pintor = htmlspecialchars($_POST['pintores']);
    $dbh=BD::getConexion(); 
    $id=null;
    $datos = new Usuario($user,$pass,$correo,$pintor,$id);
    $correcto = $datos->persist($dbh);
    if($correcto){
        $mensaje = "Registro correcto";
        include 'vistas/formulario.php';
    }else{
        $mensaje = "Usuario no registrado";
        include 'vistas/formulario.php';
    }
}elseif(isset($_POST['final'])){
    session_unset();
    session_destroy();
    $mensaje = "Introduce Datos";
    include 'vistas/formulario.php';
}elseif(isset($_POST['editar'])){
    include 'vistas/editar.php';
}elseif(isset($_POST['guardar'])){
    $user= htmlspecialchars($_POST['usuario']);
    $pass= htmlspecialchars($_POST['password']);
    $correo= htmlspecialchars($_POST['correo']);
    $pintor = htmlspecialchars($_POST['pintores']);
    $id = $_SESSION['usuario']->getId();
    $dbh=BD::getConexion();
    $datos = new Usuario($user,$pass,$correo,$pintor,$id);
    $correcto = $datos->persist($dbh);
    $_SESSION['usuario']= $datos;
    include 'vistas/cuadro.php';
}elseif(isset($_POST['borrar'])){
    $dbh=BD::getConexion();
    $_SESSION['usuario']->delete($dbh);
    session_unset();
    session_destroy();
    $mensaje = "Perfil borrado";
    include 'vistas/formulario.php';
}else{
    $mensaje = "Introduce Datos";
    include 'vistas/formulario.php';
}
        
?>
