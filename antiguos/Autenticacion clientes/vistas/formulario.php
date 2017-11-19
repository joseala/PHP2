<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <header id="cabecera">
            <h1>Inicio de sesión</h1>
            <h1><?php echo $mensaje ?></h1>  
        </header>
        <form action="index.php" method="POST">
            <div id="user">
                <h1>Nombre de Usuario</h1> 
                <?php
                echo"<input type='text' name='user'>";
                ?>
            </div>
            <div id="pass">
                <h1>Contraseña</h1> 
                <?php
                echo"<input type='text' name='pass'>";
                ?>
            </div>
           <div id="boton">
                <?php
                echo"<input type='submit' value='Enviar' name='enviar'>";
                echo"<br>";
                echo"<h2>Darse de Alta</h2>";
                echo"<input type='submit' value='Registrarse' name='registro'>";
                ?>
            </div>
        </form>    
    </body>
</html>
