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
                echo"<input type='text' name='usuario'>";
                ?>
            </div>
            <div id="pass">
                <h1>Contraseña</h1> 
                <?php
                echo"<input type='text' name='password'>";
                ?>
            </div>
            <div id="correo">
                <h1>Correo electrónico</h1> 
                <?php
                echo"<input type='text' name='correo'>";
                ?>
            </div>
            <div id="pintor">
                <h1>Pintor favorito</h1> 
                <?php
                echo"<select name='pintores'>";
                echo"<option value='../imagenes/picasso.jpg'>Picasso</option>";
                echo"<option value='../imagenes/goya.jpg'>Goya</option>";
                echo"<option value='../imagenes/dali.jpg'>Dalí</option>";
                echo"<option value='../imagenes/van.jpg'>Van gogh</option>";
                echo"</select";
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
