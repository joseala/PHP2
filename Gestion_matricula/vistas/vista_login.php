<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Gestion matricula</h1>
        <br>
        <h2><?= $mensaje ?></h2>
        <form action="index.php" method="POST">
            <br>
            <label>Nombre</label>
            <input type="text" name="nombre">
            <br>
            <label>Contraseña</label>
            <input type="text" name="pass">
            <br>
            <input type="submit" name="login" value="Login">
        </form>
    </body>
</html>
