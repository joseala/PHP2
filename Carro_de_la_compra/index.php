<?php
include_once 'clases/Carro.php';
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
            $miCompra = $_SESSION['carro']->crearXML($dbh); 
            include 'vistas/vista_resumen.php';
         }else{
            //Crear lineas 
            $carro = $usuario->getCarro($dbh); 
            $carro->setLineasCarro($dbh, $compras);
            $_SESSION['carro'] = $carro;
            include 'vistas/vista_producto.php';
         }
    }elseif (isset($_POST['nuevo'])) {
        $_SESSION['carro']->deleteLineas($dbh);
        include 'vistas/vista_menu.php';
    }elseif(isset($_POST['productos'])){
        include 'vistas/vista_producto.php';
    }else{
        unset($_SESSION['usuario']);
        unset($_SESSION['carro']);
        unset($_SESSION['productos']);
        include 'vistas/vista_formulario.php';
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
        try{
            $usuario->persist($dbh);
            $usuario->crearCarro($dbh);
            include 'vistas/vista_formulario.php';
        } catch (Exception $ex) {
            
            include 'vistas/vista_formulario.php';
        }
    }else{
        include 'vistas/vista_formulario.php';
    }
}
    
?>