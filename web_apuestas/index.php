<?php
include_once 'clases/BD.php';
include_once 'clases/Collection.php';
include_once 'clases/Usuario.php';
include_once 'clases/Apuesta.php';
session_start();
$dbh = BD::getConexion();
if(isset($_SESSION['usuario'])){
    if(isset($_POST['apostar'])){
        $apuestas = $_POST['apuestas'];
        foreach ($apuestas as $y => $apuesta) {
            if((int)$apuesta['cantidad']){
                $miApuesta = new Apuesta($_SESSION['usuario']->getId(), $y, $apuesta['resultado'], $apuesta['cantidad']);
                $miApuesta->persist($dbh);
                $_SESSION['usuario']->setApuestas($miApuesta);
            }
        }
        $mensaje = "Apuestas realizadas, haz mas apuestas si quieres!!";
        include 'vistas/vista_menu.php';
    }elseif (isset($_POST['resultado'])) {
        $xml = simplexml_load_file('xml/resultados.xml');
        $resultados = [];
        foreach ($xml as $y => $partido) {
            $resultados[(string)$partido->attributes()['id']] = ["resultado" => (string)$partido->resultado[0],"ratio" => (string)$partido->ratio[0] ];
        }
        $premios = $_SESSION['usuario']->comprobarPremios($resultados);
        include 'vistas/vista_resultado.php';
    }elseif (isset($_POST['salir'])) {
        unset($_SESSION['usuario']);
        include 'vistas/vista_login.php';
    }else{
        $mensaje = "Haz tus apuestas";
        include 'vistas/vista_menu.php';
    }
    
}else{
    if(empty($_POST)){
        include 'vistas/vista_login.php';
    }elseif(isset ($_POST['login'])){
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        $usuario = Usuario::getByCredenciales($nombre, md5($pass),$dbh);
        if($usuario){
            $_SESSION['usuario'] = $usuario;
            $_SESSION['usuario']->getApuestas($dbh);
            $mensaje = "Haz tus apuestas";
            include 'vistas/vista_menu.php';
        }else{
            include 'vistas/vista_login.php';
        }
    }elseif (isset ($_POST['registrarse'])) {
        include 'vistas/vista_registro.php';
    }elseif (isset ($_POST['registrar'])) {
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

?>
   