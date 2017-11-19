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
        <h1>Enhorabuena has Ganado</h1>
        <div id="palabra">
            <?php
            echo"<table border='1'>";
            echo"<tr>";
            echo"<td>";
            echo "Palabra";
            echo"</td>";
            echo"<td>";
            echo $_SESSION['partida']->getSolucionada();
            echo"</td>";
            echo"</tr>"; 
            echo"<tr>";
            echo"<td>";
            echo "Intentos";
            echo"</td>"; 
            echo"<td>";
            echo $_SESSION['partida']->getIntentos();
            echo"</td>";
            echo"</tr>";                        
            echo"</table>";
            ?>
        </div>
        <div id="formulario">
            <?php
            echo"<form action='index.php' method='post'>";
            echo "<input type='submit' value='Volver a jugar' name='volver'>";
            echo "<input type='submit' value='Salir' name='salir'>";
            echo"</form>";
            ?>          
        </div>
        <br>
    </body>
</html>
