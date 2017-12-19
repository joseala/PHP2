<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Vista XML</h1>
        
        <ul>
            <li>
                <h2>Profesor: <?= $_SESSION['profesor']->getNombre(); ?></h2>
            </li>
            <?php while ($alumnoActual = $_SESSION['profesor']->getAlumnos()->iterate()){?>
            <ul>
                <li>
                    <h2>Alumno: <?= $alumnoActual->getNombre(); ?></h2>
                </li>
                    <ul>
                    <?php while ($nota = $alumnoActual->getNotas()->iterate()){?>
                    <li>
                        <h2>Nota  <?= $_SESSION['profesor']->getAsignaturas()->getByProperty("id", $nota->getIdAsignatura())->getNombre() ?> : <?= $nota->getNota(); ?></h2>
                    </li>
                    <?php }?>
                    </ul>
            </ul>
            <?php }?>    
        </ul>
        <form action="index.php" method="POST">
            <input type="submit" value="Volver" name="volver">
            <input type="submit" value="Salir" name="salir">
        </form>
    </body>
</html>
