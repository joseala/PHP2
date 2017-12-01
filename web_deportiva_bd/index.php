<?php
require_once 'clases/Liga.php';
require_once 'clases/Equipo.php';
require_once 'clases/Partido.php';
require_once 'clases/Jornada.php';
require_once 'clases/BD.php';
require_once 'clases/Usuario.php';
require_once 'clases/Collection.php';
session_start();
$dbh=BD::getConexion();
if(isset($_SESSION['usuario'])){
    if(empty($_POST)){
        $liga = Liga::isLiga($dbh);
        if ($liga){
            $_SESSION['liga'] = $liga; 
            $_SESSION['liga']->recuperaJornadas($dbh);
            $_SESSION['liga']->recuperaEquipos($dbh);
            $_SESSION['descanso'] = $_SESSION['liga']->getEquipos()->getByProperty('nombre', "Descanso");
            include 'vistas/vista_jornadas.php';   
        }else {
            include 'vistas/vista_crear_liga.php'; 
        }
    }elseif (isset ($_POST['crear'])) {
        $equipos = $_POST['equipos'];
        $nombre = $_POST['nombre'];
        $array_equipos = explode(",", $equipos);
        $_SESSION['liga'] = new Liga($nombre);
        $_SESSION['liga']->persist($dbh);
        $_SESSION['liga']->creaEquipos($array_equipos,$dbh);
        $_SESSION['liga']->creaJornadas($dbh);
        $_SESSION['descanso'] = $_SESSION['liga']->getEquipos()->getByProperty('nombre', "Descanso");
        include 'vistas/vista_jornadas.php';    
    } elseif(isset ($_POST['ver'])) {
        $idJornada = $_POST['id'];
        $_SESSION['jornada'] = $_SESSION['liga']->getJornadas()->getByProperty("id", $idJornada);
        $_SESSION['jornada']->getPartidosById($idJornada,$dbh);
        $jornada = $_SESSION['jornada'];
        include 'vistas/vista_partidos.php';
    }elseif(isset ($_POST['guardar'])) {
        $resultados = $_POST['resultados'];
        unset($_POST['resultados']);
        $idJornada = $_POST['id'];
        Partido::actualizaPartidos($resultados,$dbh);
        include 'vistas/vista_jornadas.php';
    }elseif(isset ($_POST['clasificacion'])) {
        $clasificacion = $_SESSION['liga']->generaClasificacion($dbh);
        include 'vistas/vista_clasificacion.php';
    }elseif(isset ($_POST['volver'])) {
        include 'vistas/vista_jornadas.php';
    }elseif(isset ($_POST['salir'])){
        unset($_SESSION['usuario']);
        unset($_SESSION['liga']);
        unset($_SESSION['jornada']);
        unset($_SESSION['descanso']);
        include 'vistas/vista_formulario.php';
    }
}else{
    if(empty($_POST)){      
        $mensaje = "Introduce Datos";    
        include 'vistas/vista_formulario.php';    
    }elseif(isset($_POST['enviar'])){//enviar comprueba pass y user,volver vuelve al menu del usuario.   
        //Comprueba usuario contra base de datos
        $_SESSION['usuario'] = Usuario::getByCredencial($dbh,$_POST['user'],md5($_POST['pass']));
        if($_SESSION['usuario']){ 
            $liga = Liga::isLiga($dbh);
            if ($liga){
                $_SESSION['liga'] = $liga; 
                $_SESSION['liga']->recuperaJornadas($dbh);
                $_SESSION['liga']->recuperaEquipos($dbh);
                $_SESSION['descanso'] = $_SESSION['liga']->getEquipos()->getByProperty('nombre', "Descanso");
                include 'vistas/vista_jornadas.php';   
            }else {
                include 'vistas/vista_crear_liga.php'; 
            }
        }else{
            $mensaje = "Usuario no encontrado";
            include 'vistas/vista_formulario.php';
        }
    }elseif(isset ($_POST['registro'])){//Envia a formulario registro
        include 'vistas/vista_registro.php';       
    }elseif(isset ($_POST['registrarse'])){//Registra usuario y comprueba si ha sido persistido en la base de datos.
        $nombre = htmlspecialchars($_POST['nombre']);
        $pass = md5(htmlspecialchars($_POST['pass']));  
        $usuario = new Usuario($nombre,$pass); 
        try{
            $usuario->persist($dbh);
            $mensaje = "Registro correcto";
            include 'vistas/vista_formulario.php';
        } catch (Exception $ex) {
            $mensaje = "Usuario no registrado";
            include 'vistas/vista_formulario.php';
        }
    }elseif(isset ($_POST['salir'])){
        unset($_SESSION['usuario']);
        unset($_SESSION['liga']);
        unset($_SESSION['jornada']);
        unset($_SESSION['descanso']);
        include 'vistas/vista_formulario.php';
    }
    
}

?>
    
