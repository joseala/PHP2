<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="index.php" method="POST">
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
                       <?php while ($asignatura = $_SESSION['profesor']->getAsignaturas()->iterate()){ 
                        $idAlumno = $alumno->getId();
                        $idAsignatura = $asignatura->getId();
                    echo "<td><input type='number' min='0' max='10' value='0' name='notas[$idAlumno][$idAsignatura]'></td>";
                         } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <input type="submit" value="Guardar" name="guardar">
            <input type="submit" value="Salir" name="salir">
        </form>
    </body>
</html>
