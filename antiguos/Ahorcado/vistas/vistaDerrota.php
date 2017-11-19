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
        <h1>Has perdido</h1>
        <div id="palabra">
            <?php
            echo"<table border='1'>";
            echo"<tr>";
            echo"</td>"; 
            echo "<h1>Palabra oculta</h1>";
            echo"</td>";
            echo"<td>"; 
            echo "<h1>".$_SESSION['partida']->getPalabra()."</h1>";
            echo"</td>";   
            echo"<tr>";
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
    </body>
</html>
