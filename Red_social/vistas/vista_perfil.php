<!DOCTYPE html>
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
            <fieldset style="font-family: fantasy">
                <h1>RED SOCIAL</h1>
            </fieldset>
            <fieldset>
                <h2>Bienvenido/a <?= $_SESSION['usuario']->getNombre();?></h2>
                <br>
                <form action="index.php" method="POST">
                    <div class="botones">
                        <input type="submit" name="perfiles" value="Mas perfiles">
                        <input type="submit" name="frase" value="Añadir frase">
                        <input type="submit" name="resumen" value="Resumen seguidos">
                        <input type="submit" name="salir" value="Salir">
                    </div>
                </form>
            </fieldset>
        </fieldset>
        <fieldset style="background-color: greenyellow">
            <h2>Tus usuarios seguidos: </h2>
        </fieldset>
        <?php while ($usuario = $_SESSION['usuario']->getSeguidos()->iterate()){  ?>
                    <fieldset>
                    <h3>Usuario: <?= $usuario->getNombre(); ?></h3>
                <?php if($usuario->getFrases()->getNumObjects()){?>
                        <h3>Ultimo comentario: <?= $usuario->getFrases()->getLast()->getTexto(); ?></h3>
                        <h3>Fecha comentario: <?= $usuario->getFrases()->getLast()->getFecha(); ?></h3>
                <?php } else{ ?>
                            <h3>Ultimo comentario: No hay comentarios</h3>
                    <?php } ?>
                    </fieldset>
                    <br>
        <?php } ?>             
    </body>
</html>
