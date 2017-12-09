<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Bienvenido <?= $_SESSION['usuario']->getNombre(); ?> </h1>  
        <form action="index.php" method="POST">
            <h2>Mis Compras</h2>          
            <br>
            <input type="submit" value="Ver productos" name="productos" />
            <br>
            <input type="submit" value="Salir" name="salir" />
        </form>
    </body>
</html>
