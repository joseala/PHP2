<!DOCTYPE html>
<?php
if(!isset($_POST['enviar']) && !isset($_POST['guardar']))
{
    header('Location: http://localhost:8000');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div weight="200" height="30">
            <h2>
             Hola <?php echo  $_SESSION['usuario']->getUsuario(); ?>    
            </h2>               
        </div>
        <div weight="200" height="200">
            <img src= <?php echo  $_SESSION['usuario']->getPintor(); ?> />
        </div>
       <br>
       <?php 
       echo"<form action='index.php' method='POST'>";
       echo"<input type='submit' value='Finalizar' name='final'/>";
       echo"<br>";
       echo"<input type='submit' value='Editar Perfil' name='editar'/>";
       echo"<br>";
       echo"<input type='submit' value='Borrar Perfil' name='borrar'/>";
       echo"</form>";
       ?>
    </body>
</html>
