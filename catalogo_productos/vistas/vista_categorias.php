<!DOCTYPE html>as
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
                <h2><input type='radio' value='<?= $categoria->getId();?>' name='id'> ______ <?= $categoria->getNombre();?></h2>
            <?php  } ?>
            <br>
            <input type="submit" value="Ver productos categoria" name="ver">
            <br>
            <input type="submit" value="Salir" name="salir">
        </form>
    </body>
</html>
