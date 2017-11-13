<?php
require_once 'clases/Liga.php';
require_once 'clases/Equipo.php';

if(empty($_POST)){
    include 'vistas/vista_crear_liga.php';
}elseif (isset ($_POST['crear'])) {
    $equipos = $_POST['equipos'];
    $nombre = $_POST['nombre'];
    $array_equipos = explode(",", $equipos);
    $_SESSION['liga'] = new Liga($nombre);
    foreach ($array_equipos as $x => $equipo) {
        $_SESSION['liga']->setEquipos(new Equipo(trim($equipo),$x+1));
    }
    $_SESSION['liga']->creaJornadas();
    
}
?>
    
