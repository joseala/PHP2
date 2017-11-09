<?php
define("MIN",1);
define("MAX",10);

class Juego{
    public $aleatorio ;
    public $intentos = 0;
    public function generaNumero(){
        $this->aleatorio = rand(MIN, MAX);  
    }
    public function getAleatorio(){
        return $this->aleatorio;
    }           
    public function incrementaIntento(){
        $this->intentos +=1;
    }
    public function getIntentos(){
        return $this->intentos;
    }
}
session_start();
if(empty($_SESSION) || isset($_POST['volver'])){
    $partida = new Juego();
    $partida->generaNumero();
    $_SESSION['partida'] = $partida;
    include 'vistas/introduceApuesta.php';
}elseif(isset($_SESSION['partida'])){
    $numero=$_POST['numero'];
    if($_SESSION['partida']->getAleatorio()==$numero){
        include 'vistas/numeroAcertado.php';
    }else{
        $_SESSION['partida']->incrementaIntento();
        include 'vistas/introduceApuesta.php';
    }
}

?>