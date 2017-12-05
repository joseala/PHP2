<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Bienvenido </h1> <?= $_SESSION['usuario']->getNombre(); ?> 
        <form action="index.php" method="POST">
            <h2>Mis Compras</h2>
            <?php 
                
            ?>           
            <br>
            <input type="submit" value="Ver resumen" name="resumen" />
            <br>
            <input type="submit" value="Ver productos" name="productos" />
        </form>
    </body>
</html>
