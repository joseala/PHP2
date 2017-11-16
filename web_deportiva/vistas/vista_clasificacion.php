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
                    <th>Posicion</th>
                    <th>Equipo</th>
                    <th>Goles a favor</th>
                    <th>Goles en contra</th>
                    <th>Diferencia de goles</th>
                    <th>Puntos</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $posicion = 1;
                foreach ($clasificacion as $x => $equipo) { 
                    
                ?>
                <tr>
                    <td> <?= $posicion; ?> </td>
                    <td><?= $equipo['Nombre']; ?></td>
                    <td><?= $equipo['GF']; ?></td>
                    <td><?= $equipo['GC']; ?></td>
                    <td><?= $equipo['GA']; ?></td>
                    <td><?= $equipo['Puntos']; ?></td>
                </tr>
                <?php
                    $posicion++;
                } 
                ?>
            </tbody>
        </table>
        <form action="index.php" method="POST">
        <?php
            echo "<input type='submit' value='Volver' name='volver'>";
        ?>
        </form>
    </body>
</html>
