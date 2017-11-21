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
        <form action="index.php" method="POST">
    <h1>Resumen de la partida elegida</h1>
    <?php 
    $jugadas = $_SESSION['partida']->getJugadas();
    $idPartida = $_SESSION['partida']->getIdPartida();
    echo '<ul>';
    echo "<li> Id Partida: ".$idPartida."</li>";
    while($jugada = $jugadas->iterate()){ 
        echo "<li>";  
            echo '<ul>';
            echo "<li> Id Jugada: ".$jugada->getIdJugada()."</li>";
            echo "<li> Palabra encontrada: ".$jugada->getSolucionada()."</li>";
            echo "<li> Letra : ".$jugada->getLetra()."</li>";
            echo '</ul>';
        echo "</li>";  
    }
    echo '</ul>'; 
    ?>
    <input type="submit" name="volver" value="Volver">
    <input type="submit" name="salir" value="Salir">
</form>
    </body>
</html>
