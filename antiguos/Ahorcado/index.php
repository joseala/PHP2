<?php
require_once 'clases/Palabras.php';
require_once 'clases/BD.php';
require_once 'clases/Partida.php';
require_once 'clases/Usuario.php';
require_once 'clases/Jugada.php';
session_start();
$dbh=BD::getConexion();
if(isset($_SESSION['usuario'])){
    if(isset($_POST['nuevo'])){//Nuevo juego,genera palabra oculta,crea nueva partida.
        $usuario = $_SESSION['usuario'];
        $_SESSION['partida'] = new Partida();
        $_SESSION['partida']->persist($dbh, $usuario->getId());
        $_SESSION['usuario']->getPartidas()->add($_SESSION['partida']);
        include 'vistas/vistaJuego.php';
    }elseif(isset ($_POST['jugar'])){//Accede con juego comenzado,comprueba letra,actualiza letras usadas,persiste jugada actual y partida.
        $letra = strtolower($_POST['letra']);
        $jugada = new Jugada($letra);
        $esFin = $_SESSION['partida']->compruebaJugada($dbh,$jugada);
        $_SESSION['partida']->persist($dbh, $_SESSION['usuario']->getId());
        if($esFin){
            include 'vistas/vistaVictoria.php';
        }else{
            if($_SESSION['partida']->getPerdida()){
                //Borra partida perdida de coleccion
                $_SESSION['usuario']->getPartidas()->removeByProperty('idPartida', $_SESSION['partida']->getIdPartida());
                //Borra partida perdida de base de datos
                $_SESSION['partida']->delete($dbh,$_SESSION['partida']->getIdPartida());
                //Borra jugadas de partida perdida de base de datos
                $jugada->delete($dbh,$_SESSION['partida']->getIdPartida());
                include 'vistas/vistaDerrota.php';
            }else{
                include 'vistas/vistaJuego.php';
            }
        }
    }elseif (isset ($_POST['recuperar'])) {//Recupera partidas empezadas y no acabadas.
        if(!empty($_POST["idPartida"])){
            $id = $_POST["idPartida"];
            $_SESSION['partida'] = $_SESSION['usuario']->getPartidas()->getByProperty('idPartida', $id);
            include 'vistas/vistaJuego.php';
        }else{
            include 'vistas/vistaMenu.php';  
        }
    }elseif (isset ($_POST['salir'])) {//Sale del juego
        unset($_SESSION['partida']);
        unset($_SESSION['usuario']);
        $mensaje = "Introduce Datos";
        include 'vistas/formulario.php';
    }else if (isset($_POST['resumen'])){//Genera fichero XML y muestra vista XML 
        if(!empty($_POST["idPartida"])){
            $id = $_POST["idPartida"];  
            $_SESSION['partida'] = Partida::getByIdPartida($dbh,$id);
            $_SESSION['partida']->crearXml($id);
            include 'vistas/vistaXml.php';
        }else{
            include 'vistas/vistaMenu.php';
        }
    }elseif(isset($_POST['volver'])){
        include 'vistas/vistaMenu.php'; 
    }else{
        include 'vistas/vistaMenu.php';
    }
 }else{
    if(empty($_POST)){      
        $mensaje = "Introduce Datos";    
        include 'vistas/formulario.php';    
    }elseif(isset($_POST['enviar'])){//enviar comprueba pass y user,volver vuelve al menu del usuario.   
        //Comprueba usuario contra base de datos
        $_SESSION['usuario'] = Usuario::getByCredencial($dbh,$_POST['user'],md5($_POST['pass']));
        if($_SESSION['usuario']){       
            include 'vistas/vistaMenu.php';       
        }else{
            $mensaje = "Usuario no encontrado";
            include 'vistas/formulario.php';
        }
    }elseif(isset ($_POST['registro'])){//Envia a formulario registro
        include 'vistas/registro.php';       
    }elseif(isset ($_POST['registrarse'])){//Registra usuario y comprueba si ha sido persistido en la base de datos.
        $nombre = htmlspecialchars($_POST['nombre']);
        $pass = md5(htmlspecialchars($_POST['pass']));  
        $usuario = new Usuario($nombre,$pass); 
        try{
            $usuario->persist($dbh);
            $mensaje = "Registro correcto";
            include 'vistas/formulario.php';
        } catch (Exception $ex) {
            $mensaje = "Usuario no registrado";
            include 'vistas/formulario.php';
        }
    }   
}


?>
