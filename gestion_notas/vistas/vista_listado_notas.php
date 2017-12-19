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
        <table border="1">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Matematicas</th>
                    <th>Lenguaje</th>
                    <th>Ingles</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($alumno = $_SESSION['profesor']->getAlumnos()->iterate()){ ?>
                <tr>
                    <td><?= $alumno->getNombre(); ?></td>
                    <?php while ($nota = $alumno->getNotas()->iterate()){ ?>
                    <td><?= $nota->getNota(); ?></td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <form action="index.php" method="POST">
            <input type="submit" value="Listado XML" name="xml">
            <input type="submit" value="Salir" name="salir">
        </form>
    </body>
</html>
