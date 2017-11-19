<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Juego del ahorcado</h1>    
            <div id="formulario">
            <?php
            echo"<form action='index.php' method='post'>"; 
            echo"<h1>Usuario: ".$_SESSION['usuario']->getNombre()."</h1>";
            echo"<h1>Juego nuevo</h1>";
            echo "<input type='submit' value='Nuevo Juego' name='nuevo'>";                  
            echo"<h1>Partidas pendientes</h1>";
            echo "<table>";
            while($partidas = $_SESSION['usuario']->getPartidas()->iterate()){
                $a = $partidas;
                if(!$partidas->getAcabada()){
                    echo "<tr><td><input type='radio' name='idPartida' value=".$a->getIdPartida().">".$a->getIdPartida()."</td>";
                    echo"<td background:'red'></td>";
                    $x= count(str_split($a->getSolucionada()));
                    for($y=0;$y < $x;$y++){
                        echo "<td>".$a->getSolucionada()[$y]."</td>";
                    }
                    echo "</tr>";
                }
            }
            echo "</table>";
            echo "<input type='submit' value='Recuperar' name='recuperar'>";
            echo"<br>"; 
            echo "<h1>Partidas acabadas:</h1><br>";
            echo "<table>";
            while($partidas = $_SESSION['usuario']->getPartidas()->iterate()){
                $a = $partidas;
                if($partidas->getAcabada()){
                    echo "<tr><td><input type='radio' name='idPartida' value=".$a->getIdPartida().">".$a->getIdPartida()."</td>";
                    echo"<td background:'red'></td>";
                    $x= count(str_split($a->getSolucionada()));
                    for($y=0;$y < $x;$y++){
                        echo "<td>".$a->getSolucionada()[$y]."</td>";
                    }
                    echo "</tr>";
                }
            }
            echo "</table>";
            echo "<input type='submit' value='Resumen partida' name='resumen'>";
            echo "<input type='submit' value='Salir' name='salir'>";
            echo"</form>";
            ?>          
        </div>
     
    </body>
</html>
