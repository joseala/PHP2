
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1> Contabilidad familiar</h1>
        <br>
        <h2> <?= $mensaje; ?> </h2>
        <br>
        <form action="index.php" method="POST">
            <label>Nombre: </label>
            <input type="text" name="nombre">
            <br>
            <label>Contraseña: </label>
            <input type="text" name="pass">
            <br>
            <input type="submit" value="Login" name="login"> 
            <br>
            <input type="submit" value="Registrarse" name="registrarse">
        </form>
    </body>
</html>
