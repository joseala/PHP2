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
    </head>
    <body>
        <h1>Modifica Alumno</h1>
        <form action="index.php" method="POST">
            <br>
            <label>Nombre</label>
            <input type="text" value="<?= $alumno->getNombre(); ?>" name="nombre">
            <br>
            <label>Primer apellido</label>
            <input type="text" value="<?= $alumno->getApellido1(); ?>" name="apellido1">
            <br>
            <label>Segundo apellido</label>
            <input type="text" value="<?= $alumno->getApellido2(); ?>" name="apellido2">
            <br>
            <label>Edad</label>
            <input type="number" value="<?= $alumno->getEdad(); ?>" name="edad">
            <br>
            <label>Sexo</label>
            <h3><input type="radio" value="femenino" name="sexo" checked="checked">_Femenino</h3>
            <h3><input type="radio" value="masculino" name="sexo">_Masculino</h3>
            <br>
            <input type="submit" name="guardarModificar" value="Guardar">
            <br>
            <input type="submit" name="volver_grupo" value="Volver">
            <br>
            <input type="submit" name="salir" value="salir">
        </form>
    </body>
</html>
