<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .botones{
                width: 350px;
                height: 25px;
            }
        </style>
    </head>
    <body>
        <h1>GESTION NOTAS</h1>
        <form action="index.php" method="POST">
            <fieldset>
            <label>Nombre</label>
            <input type="text" name="nombre">
            </fieldset>
            <fieldset>
            <label>Contraseña</label>
            <input type="text" name="pass">
            </fieldset>
            <div class="botones">
                <input type="submit" value="Login" name="login">
                <input type="submit" value="Registrarse" name="registrarse">
            </div>
        </form>
    </body>
</html>
