<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       <h1>Alta nuevo Alumno</h1>
        <form action="index.php" method="POST">
            <br>
            <label>Nombre</label>
            <input type="text" name="nombre">
            <br>
            <label>Primer apellido</label>
            <input type="text" name="apellido1">
            <br>
            <label>Segundo apellido</label>
            <input type="text" name="apellido2">
            <br>
            <label>Edad</label>
            <input type="number" name="edad">
            <br>
            <label>Sexo</label>
            <h3><input type="radio" value="femenino" name="sexo" checked="checked">_Femenino</h3>
            <h3><input type="radio" value="masculino" name="sexo">_Masculino</h3>
            <br>
            <input type="submit" name="guardar" value="Guardar">
            <br>
            <input type="submit" name="volver_grupo" value="Volver">
            <br>
            <input type="submit" name="salir" value="salir">
        </form>
    </body>
</html>
