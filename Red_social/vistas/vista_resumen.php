<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Red Social</h1>
        <br>
        <?php foreach ($frases as $y => $frase) { ?>
            <h2>Usuario: <?= $_SESSION['usuario']->getSeguidos()->getByProperty("id", $y)->getNombre(); ?></h2>
            <ul>
            <?php  foreach ($frase as $y => $texto) { ?>
                <li><h2>Frase: <?= $texto->getTexto(); ?></h2></li>             
           <?php } ?>
           </ul> 
       <?php }  ?>
            <form action="index.php" method="POST">
                <br>
                <input type="submit" name="volver" value="Volver">
                <br>
                <input type="submit" name="salir" value="Salir">
            </form>
    </body>
</html>
