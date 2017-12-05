<?php
include_once 'clases/Linea.php';
include_once 'clases/Producto.php';
include_once 'clases/Usuario.php';
include_once 'clases/BD.php';
include_once 'clases/Collection.php';
session_start();
$dbh = BD::getConexion();
if(isset($_SESSION['usuario'])){
    $usuario = $_SESSION['usuario'];
    $_SESSION['productos'] = Producto::getProductos($dbh);
    $productos = $_SESSION['productos'];
    if(isset($_POST['comprar'])){
        $compras = $_POST['compras'];    
        $columna_cantidades = array_column($compras, 'cantidad');
         if(1== count(array_unique($columna_cantidades))){
            include 'vistas/vista_resumen.php';
         }else{
            //Crear lineas 
            include 'vistas/vista_producto.php';
         }
    }else{
        $_SESSION['productos'] = Producto::getProductos($dbh);
        $productos = $_SESSION['productos'];
        include 'vistas/vista_producto.php';
    }
}else{
    if(empty($_POST)){        
        include 'vistas/vista_formulario.php';
    }elseif (isset ($_POST['loguear'])) {
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        $logueado = Usuario::getCredenciales($nombre, md5($pass),$dbh);
        if($logueado){
            $_SESSION['usuario'] = $logueado;
            include 'vistas/vista_menu.php';
        }else{
            include 'vistas/vista_formulario.php';
        }
    }elseif (isset ($_POST['registro'])) {
        include 'vistas/vista_registro.php';
    }elseif (isset($_POST['registrar'])) {
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        $correo = $_POST['correo'];
        $usuario = new Usuario($nombre, md5($pass), $correo);
        $logueado = $usuario->persist($dbh);
        if($logueado){
            $_SESSION['usuario'] = $logueado;
            include 'vistas/vista_menu.php';
        }else{
            include 'vistas/vista_formulario.php';
        }
    }else{
        include 'vistas/vista_formulario.php';
    }
}
    
?>