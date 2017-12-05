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
        <form action="index.php" method="POST">
            <table border="1">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Ref</th>
                        <th>Denominacion</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $y => $producto) { ?>
                        <tr>
                            <td>Foto</td>
                            <td><input type='text' readonly value="<?php $producto->getId(); ?>" name="compras[<?php $y; ?>]['id']"</td>
                            <td><?= $producto->getDenominacion(); ?></td>
                            <td><?= $producto->getPrecio(); ?></td>
                            <td><select name="compras[<?php $y; ?>]['cantidad']">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <input type="submit" value="Comprar" name="comprar" />          
        </form>
    </body>
</html>
