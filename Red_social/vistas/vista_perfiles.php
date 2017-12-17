<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .botones{
                width: 450px;
                height: 25px;
            }
        </style>
    </head>
    <body>
        <h1>RED SOCIAL</h1>
        <br>
        <h1>Perfiles no seguidos</h1>
        <br>
        <form action="index.php" method="POST">           
            <?php while ($usuario = $_SESSION['usuario']->getNoSeguidos()->iterate()) { 
                $id = $usuario->getId(); ?>
                <h2><input type='radio' name='id' value='<?= $id; ?>'>
                <?= $usuario->getNombre(); ?></h2>
                <br>
            <?php } ?>
            <div class="botones">
            <?php if($_SESSION['usuario']->getNoSeguidos()->getNumObjects() == 0){?>
                 <h1>No hay perfiles para seguir</h1>
            <?php }else{?>
                    <input type="submit" name="seguir" value="Seguir">
            <?php } ?>
            <input type="submit" name="volver" value="Volver">          
            <input type="submit" name="salir" value="Salir">
            </div>
        </form>
    </body>
</html>
