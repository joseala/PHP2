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
        <h1>Grupo <?= $grupo->getNombre();?> </h1>
        <br> 
        <form action="index.php" method="POST">
            <table border="1">
                <thead>
                    <tr>
                        <th>___</th>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO 1</th>
                        <th>APELLIDO 2</th>
                        <th>EDAD</th>
                        <th>SEXO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($alumno = $grupo->getAlumnos()->iterate()) { ?>
                    <tr>
                        <td><input type="radio" value="<?= $alumno->getId();?>" name="id"></td>
                        <td><?= $alumno->getId();?></td>
                        <td><?= $alumno->getNombre();?></td>
                        <td><?= $alumno->getApellido1();?></td>
                        <td><?= $alumno->getApellido2();?></td>
                        <td><?= $alumno->getEdad();?></td>
                        <td><?= $alumno->getSexo();?></td>
                    </tr>

            <?php }?>
                </tbody>
            </table>    
            <br> 
            <input type="submit" value="Añadir alumno/a" name="nuevo">
            <br> 
            <input type="submit" value="Borrar alumno/a" name="borrar">
            <br> 
            <input type="submit" value="Modificar alumno/a" name="modificar">
            <br> 
            <input type="submit" value="Crear XML" name="xmlFile">
            <br> 
            <input type="submit" value="Volver" name="volver_grupos">
            <br>
            <input type="submit" value="Salir" name="salir">
        </form>
    </body>
</html>
