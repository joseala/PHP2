<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <header id="cabecera">
            <h1>Editar</h1>  
        </header>
        <form action="index.php" method="POST">
            <div id="user">
                <h1>Nombre de Usuario</h1>                
                <input type='text' name='usuario' value= <?php echo $_SESSION['usuario']->getUsuario();?>>            
            </div>
            <div id="pass">
                <h1>Contraseña</h1> 
                <input type='text' name='password' value= <?php echo $_SESSION['usuario']->getPassword();?>>
            </div>
            <div id="correo">
                <h1>Correo electrónico</h1>         
                <input type='text' name='correo' value= <?php echo $_SESSION['usuario']->getCorreo();?>>
            </div>
            <div id="pintor">
                <h1>Pintor favorito</h1> 
                <select name='pintores' value= '<?php echo $_SESSION['usuario']->getPintor();?>'>";
                    <option value='../imagenes/picasso.jpg'>Picasso</option>
                    <option value='../imagenes/goya.jpg'>Goya</option>
                    <option value='../imagenes/dali.jpg'>Dalí</option>
                    <option value='../imagenes/van.jpg'>Van gogh</option>
                </select>
            </div>
            <br>
            <div id="boton">
                <?php
                echo"<input type='submit' value='Guardar cambios' name='guardar'>";
                ?>
            </div>
        </form>    
    </body>
</html>
