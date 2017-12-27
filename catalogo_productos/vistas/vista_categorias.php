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
        <h1>Tienda</h1>
        <br>
        <h1>Categorias</h1>
        <br>
        <form action="index.php" method="POST">
            <?php foreach ($categorias as $categoria) { ?>
                <h2><input type='radio' value='<?= $categoria->getId();?>' name='id'> <?= $categoria->getNombre();?></h2>
            <?php  } ?>
            <br>
            <input type="submit" value="Ver productos categoria" name="ver">
            <br>
            <input type="submit" value="Salir" name="salir">
        </form>
    </body>
</html>
