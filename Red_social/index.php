<?php
include_once 'clases/BD.php';
include_once 'clases/Collection.php';
include_once 'clases/Usuario.php';
include_once 'clases/Frase.php';
session_start();
$dbh = BD::getConexion();
if(isset($_SESSION['usuario'])){
    if(isset($_POST['frase'])){
        
        include "vistas/vista_frases.php"; 
        
    }elseif (isset($_POST['perfiles'])) { 
        
        $_SESSION['usuario']->recuperaNoSeguidos($dbh);
        include "vistas/vista_perfiles.php";
        
    }elseif (isset($_POST['volver'])) {   
        
        include "vistas/vista_perfil.php";
        
    }elseif (isset($_POST['resumen'])) {
        
        //$frases = Frase::recuperaFrases($dbh, $_SESSION['usuario']->getSeguidos());//Recupera todas las frases de los usuarios seguidos
        $_SESSION['usuario']->crearXML($frases);//Crea el archivo XML
        include "vistas/vista_resumen.php"; 
        
    }elseif (isset($_POST['seguir'])) {
        
        $id = $_POST['id'];
        $_SESSION['usuario']->persistSeguido($dbh, $id, $_SESSION['usuario']->getId());
        $_SESSION['usuario']->getSeguidos()->removeAll();//Borra la coleccion de seguidos
        $_SESSION['usuario']->recuperaSeguidos($dbh);//Añade usuarios a la coleccion incluyendo el ultimo añadido.
        $_SESSION['usuario']->getNoSeguidos()->removeAll();;//Borra usuario nuevo seguido en coleccion de no seguidos.        
        include "vistas/vista_perfil.php"; 
        
    }elseif (isset($_POST['salir'])) {
        
        unset($_SESSION['usuario']);
        $mensaje = "Loguin o Registro";
        include "vistas/vista_login.php";
        
    }elseif (isset($_POST['guardar'])) {
        
        $texto = $_POST['texto'];
        $frase = new Frase($_SESSION['usuario']->getId(), $texto, date("Y-m-d H:i:s"));
        $frase->persist($dbh);
        include "vistas/vista_perfil.php";
        
    } else {
        
        include "vistas/vista_perfil.php"; 
    }
    
}else{
    if(isset($_POST['login'])){
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        $usuario = Usuario::getByCrecencial($dbh, $nombre, md5($pass));
        if($usuario){  
            $_SESSION['usuario'] = $usuario;
            $_SESSION['usuario']->recuperaSeguidos($dbh);
            include "vistas/vista_perfil.php";           
        }else{
            $mensaje = "Usuario no encontrado,registrese";
            include "vistas/vista_login.php";
        }       
    }elseif(isset ($_POST['registrarse'])){
        include "vistas/vista_registro.php";
    }elseif(isset ($_POST['registrar'])){
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        if($nombre == "" || $pass == "" ){
            $mensaje = "Usuario no registrado, algun campo vacio";
            include "vistas/vista_login.php";
        }else{
            $usuario = new Usuario($nombre, md5($pass));
            try {
                $usuario->persist($dbh);
                $mensaje = "Usuario registrado";
                include "vistas/vista_login.php";
            } catch (Exception $ex) {
                $mensaje = "Usuario no registrado";
                include "vistas/vista_login.php";
            }
        }       
    }else{
        $mensaje = "Loguin o Registro";
        include "vistas/vista_login.php";
    }
}
       
?>
   