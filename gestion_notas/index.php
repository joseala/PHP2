<?php
include_once 'clases/BD.php';
include_once 'clases/Collection.php';
include_once 'clases/Profesor.php';
include_once 'clases/Alumno.php';
include_once 'clases/Nota.php';
include_once 'clases/Asignatura.php';
$dbh = BD::getConexion();
session_start();
if(isset($_SESSION['profesor'])){
    if(isset($_POST['guardar'])){
        $notas = $_POST['notas'];
        $_SESSION['profesor']->guardaNotas($dbh,$notas);
        include 'vistas/vista_listado_notas.php';
    }elseif (isset($_POST['xml'])) {
        $_SESSION['profesor']->crearXML($dbh);
        include 'vistas/vista_XML.php';
    }elseif (isset($_POST['salir'])) {
        unset($_SESSION['profesor']);
        include 'vistas/vista_login.php';
    }elseif (isset($_POST['volver'])) {
        include 'vistas/vista_listado.php';
    }else{
        include 'vistas/vista_listado.php';
    }
}else {
    if(isset($_POST['login'])){         
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        $profesor = new Profesor($nombre,$pass);
        $logueado = $profesor->getCredenciales($dbh);
        if($logueado){
            $_SESSION['profesor'] = $profesor;
            include 'vistas/vista_listado.php';
        }else{
            include 'vistas/vista_login.php';
        }       
    }else{
        include 'vistas/vista_login.php';
    }  
}
?>
    
