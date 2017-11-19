<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <header id="cabecera">
            <h1>Registro</h1>  
        </header>
        <form action="index.php" method="POST">
            <div id="user">
                <h1>Nombre de Usuario</h1> 
                <?php
                echo"<input type='text' name='nombre'>";
                ?>
            </div>
            <div id="pass">
                <h1>Contraseña</h1> 
                <?php
                echo"<input type='text' name='pass'>";
                ?>
            </div>
            <br>
            <div id="boton">
                <?php
                echo"<input type='submit' value='Registrarse' name='registrarse'>";
                ?>
            </div>
        </form>    
    </body>
</html>
