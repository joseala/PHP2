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
        <h1>RED SOCIAL</h1>
        <h2>Bienvenido <?= $_SESSION['usuario']->getNombre();?></h2>
        </fieldset>
        <?php while ($usuario = $_SESSION['usuario']->getSeguidos()->iterate()){  ?>
                    <fieldset>
                    <h3>Usuario: <?= $usuario->getNombre(); ?></h3>
                <?php if($usuario->getFrases()->getNumObjects()){?>
                        <h3>Ultimo comentario: <?= $usuario->getFrases()->getLast()->getTexto(); ?></h3>
                        
                <?php } else{ ?>
                            <h3>Ultimo comentario: No hay comentarios</h3>
                    <?php } ?>
                    </fieldset>
                    <br>
        <?php } ?>       
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
