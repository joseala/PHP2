<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       <h1>Tienda</h1>
        <br>
        <h1><?= $categoriaActual->getNombre();?></h1>
        <br>
        <form action="index.php" method="POST">
            <?php while ($producto = $categoriaActual->getProductos()->iterate()) { ?>
                <h2><input type='radio' value='<?= $producto->getId();?>' name='id'>Denominacion: <?= $producto->getNombre();?> Precio: <?= $producto->getPrecio();?></h2>
            <?php  } ?>
            <br>
            <input type="submit" value="Crear producto" name="crear">
            <br>
            <?php  if(!$categoriaActual->getProductos()->isEmpty()){ ?>
                <input type="submit" value="Modificar producto" name="modificar">
                <br>
                <input type="submit" value="Borrar producto" name="borrar">
                <br>
            <?php  } ?>
            <input type="submit" value="Volver a categorias" name="volverCategorias">
            <br>
            <input type="submit" value="Salir" name="salir">
        </form>
    </body>
</html>
