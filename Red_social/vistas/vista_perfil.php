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
        <style>
            .botones{
                width: 600px;
                height: 25px;
            }
        </style>
    </head>
    <body>
        <fieldset>
        <h1>RED SOCIAL</h1>
        <h2>Bienvenido <?= $_SESSION['usuario']->getNombre();?></h2>
        </fieldset>
        <?php while ($frase = $_SESSION['usuario']->getFrases()->iterate()){   
            echo "<fieldset>";
            echo "<h3>Usuario: ".$_SESSION['usuario']->getSeguidos()->getByProperty("id", $frase->getIdUsuario())->getNombre()."</h3>";
            echo "<h3>Ultimo comentario: ".$frase->getTexto()."</h3>";
            echo "</fieldset>";
            echo "<br>";
        } ?>
        
            <form action="index.php" method="POST">
                <div class="botones">
                    <input type="submit" name="perfiles" value="Mas perfiles">
                    <input type="submit" name="frase" value="Añadir frase">
                    <input type="submit" name="resumen" value="Resumen seguidos">
                    <input type="submit" name="salir" value="Salir">
                </div>
            </form>
        
    </body>
</html>
