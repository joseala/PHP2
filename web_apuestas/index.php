<?php
include_once 'clases/BD.php';
include_once 'clases/Collection.php';
include_once 'clases/Usuario.php';
session_start();
$dbh = BD::getConexion();
if(isset($_SESSION['usuario'])){
    
}else{
    if(empty($_POST)){
        include 'vistas/vista_login.php';
    }elseif(isset ($_POST['login'])){
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        
    }elseif (isset ($_POST['registrarse'])) {
        include 'vistas/vista_registro.php';
    }elseif (isset ($_POST['registar'])) {
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        $usuario = new Usuario($nombre, md5($pass));
        try {
            $usuario->persist($dbh);
            $mensaje = "Estas Logueado";
            include 'vistas/vista_login.php';
        } catch (Exception $exc) {
            $mensaje = "ERROR, No estas Logueado";
            include 'vistas/vista_login.php';
        }
    }else{
        include 'vistas/vista_login.php';
    }
}
$xml = simplexml_load_file('xml/resultados.xml');
$resultados = [];
foreach ($xml as $y => $partido) {
    $resultados[(string)$partido->attributes()['id']] = [(string)$partido->resultado[0]];
    
}
?>
   