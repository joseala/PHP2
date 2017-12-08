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
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $total = 0;
                    foreach ($miCompra as $y => $linea) { 
                ?>
                <tr>
                    <td><?= $y;?></td>
                    <td><?= $linea['denominacion']; ?></td>
                    <td><?= $linea['precio']; ?></td>
                    <td><?= $linea['cantidad']; ?></td>
                    <?php
                        $totalActual = (int)$linea['precio'] * (int)$linea['cantidad'];
                        $total += $totalActual;
                    ?>
                    <td><?= $totalActual;?></td>
                </tr>
           <?php } ?>
                <tr>
                    <td></td>
                    <td><?= $total;?></td>
                </tr>
            </tbody>
        </table>
        <form action="index.php" method="POST">
            <?php
            echo "<input type='submit' name='nuevo' value='Nueva compra'>";
            ?>
        </form>
    </body>
</html>
