<?php
include_once 'clases/BD.php';
include_once 'clases/Collection.php';
include_once 'clases/Usuario.php';
include_once 'clases/Apunte.php';
session_start();
$dbh = BD::getConexion();
define("GASTO", "gasto");
define("INGRESO", "ingreso");
if(isset($_SESSION['usuario'])){
    if (isset($_POST['nuevo'])) {
        unset($_SESSION['filtrado']);
        include 'vistas/vista_nuevo_apunte.php';
    }elseif (isset($_POST['guardar'])) {
        $total = 0;
        $usuario = $_SESSION['usuario'];
        $tipo = $_POST['tipo'];
        $concepto = $_POST['concepto'];
        $cantidad = (int)$_POST['cantidad'];
        $fecha = $_POST['fecha'];
        ($tipo == "gasto")? $cantidad = $cantidad * (-1) : $cantidad;
        $apunte = new Apunte($usuario->getId(),$tipo, $concepto, $cantidad, date($fecha));
        $apunte->persist($dbh);
        $usuario->getApuntes()->add($apunte);
        include 'vistas/vista_contabilidad.php';
        
    } elseif (isset($_POST['total'])) {
        $usuario = $_SESSION['usuario'];
        if(isset($_SESSION['filtrado'])){
            $filtrado = $_SESSION['filtrado'];
            $total = 0;
            foreach ($filtrado as $apunte) {
                $total += $apunte['cantidad'];
            }
        }else{
            $total = $usuario->getTotal();
        }        
        include 'vistas/vista_contabilidad.php';
    }elseif (isset($_POST['filtrar'])) {
        unset($_SESSION['filtrado']);
        if(filter_input(INPUT_POST, 'desde') && filter_input(INPUT_POST, 'hasta') && filter_input(INPUT_POST, 'tipo')){
            $tipo = $_POST['tipo'];
            $desde = $_POST['desde'];
            $hasta = $_POST['hasta'];
            $_SESSION['filtrado'] = Apunte::getFiltradoTodo($dbh,$_SESSION['usuario']->getId(),$desde,$hasta,$tipo);
            $filtrado = $_SESSION['filtrado'];
            $total = 0;
            include 'vistas/vista_contabilidad.php';
        }elseif(filter_input(INPUT_POST, 'desde') && filter_input(INPUT_POST, 'hasta')){
            $desde = $_POST['desde'];
            $hasta = $_POST['hasta'];
            $_SESSION['filtrado'] = Apunte::getFiltrado($dbh,$_SESSION['usuario']->getId(),$desde,$hasta);
            $filtrado = $_SESSION['filtrado'];
            $total = 0;
            include 'vistas/vista_contabilidad.php'; 
        }elseif(!filter_input(INPUT_POST, 'desde') && !filter_input(INPUT_POST, 'hasta') && filter_input(INPUT_POST, 'tipo')){
            $tipo = $_POST['tipo'];
            $_SESSION['filtrado'] = Apunte::getFiltradoTipo($dbh,$_SESSION['usuario']->getId(),$tipo);
            $filtrado = $_SESSION['filtrado'];
            $total = 0;
            include 'vistas/vista_contabilidad.php'; 
        }else{
            $total = 0;
            $usuario = $_SESSION['usuario'];
            include 'vistas/vista_contabilidad.php';    
        }
    }elseif (isset($_POST['volver'])) {
        unset($_SESSION['filtrado']);
        $total = 0;
        $usuario = $_SESSION['usuario'];
        include 'vistas/vista_contabilidad.php';
    }elseif (isset($_POST['salir'])) {
        unset($_SESSION['filtrado']);
        unset($_SESSION['usuario']);
        $mensaje = "Bienvenido a la app de contabilidad";
        include 'vistas/vista_login.php';
    }else{
        $total = 0;
        $usuario = $_SESSION['usuario'];
        include 'vistas/vista_contabilidad.php';
    }
}else{
    if(isset($_POST['login'])){
        if(filter_input(INPUT_POST, 'nombre') && filter_input(INPUT_POST, 'pass')){
            $nombre = $_POST['nombre'];
            $pass = $_POST['pass'];
            $usuario = Usuario::getByCredenciales($dbh,$nombre, md5($pass));
            if($usuario){
                $_SESSION['usuario'] = $usuario;
                $_SESSION['usuario']->getApuntesByCredenciales($dbh);
                $total = 0;
                include 'vistas/vista_contabilidad.php';
            }else{
                $mensaje = "No se ha podido encontrar, registrese.";
                include 'vistas/vista_login.php';
            }
        }else{
            $mensaje = "No se ha intoducido el nombre o la contraseña.";
            include 'vistas/vista_login.php';
        }
    }elseif (isset ($_POST['registrarse'])) {
         $mensaje = "Intoduzca nombre y contraseña.";
        include 'vistas/vista_registro.php';
    }elseif (isset ($_POST['registrar'])) {
        if(filter_input(INPUT_POST, 'nombre') && filter_input(INPUT_POST, 'pass')){
            $nombre = $_POST['nombre'];
            $pass = $_POST['pass'];
            $usuario = new Usuario($nombre,md5($pass));
            try {
                $usuario->persist($dbh);
                $mensaje = "Registrado correctamente.";
                include 'vistas/vista_login.php';

            } catch (Exception $e) {
                $mensaje = "No se ha podido registrar, intentelo de nuevo.";
                include 'vistas/vista_login.php';
            } 
        }else{
            $mensaje = "No se ha intoducido el nombre o la contraseña.";
            include 'vistas/vista_registro.php';
        }
    } else {
        $mensaje = "Bienvenido a la app de contabilidad";
        include 'vistas/vista_login.php';
    }
}
?>
    