<?php
require_once 'clases/Liga.php';
require_once 'clases/Equipo.php';
session_start();
if(empty($_POST) || isset($_POST['salir'])){
    include 'vistas/vista_crear_liga.php';
}elseif (isset ($_POST['crear'])) {
    $equipos = $_POST['equipos'];
    $nombre = $_POST['nombre'];
    $array_equipos = explode(",", $equipos);
    $_SESSION['liga'] = new Liga($nombre,$array_equipos);
    include 'vistas/vista_jornadas.php';    
} elseif(isset ($_POST['ver'])) {
    $idJornada = $_POST['id'];
    $jornada = $_SESSION['liga']->getJornadas()->getByProperty("id", $idJornada);
    include 'vistas/vista_partidos.php';
}elseif(isset ($_POST['guardar'])) {
    $resultados = $_POST['resultados'];
    $idJornada = $_POST['id'];
    $jornada = $_SESSION['liga']->getJornadas()->getByProperty("id", $idJornada);
    $jornada->actualizaPartido($resultados);
    include 'vistas/vista_jornadas.php';
}elseif(isset ($_POST['clasificacion'])) {
    $clasificacion = $_SESSION['liga']->generaClasificacion();
    include 'vistas/vista_clasificacion.php';
}elseif(isset ($_POST['volver'])) {
    include 'vistas/vista_jornadas.php';
}else{
    include 'vistas/vista_crear_liga.php';
}
?>
    
