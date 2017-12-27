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
        <h1>Modificar un producto</h1>
         <br>
        <form action="index.php" method="POST">
            <br>
            <label>Nombre</label>
            <?php $nombre = $_SESSION['producto']->getNombre();?>
            <input type='text' value='<?= $nombre; ?>' name='nombre'>
            
            <br>
            <label>Precio</label>
            <?php 
                $idCategoria = $_SESSION['producto']->getIdCategoria();
                $precio = $_SESSION['producto']->getPrecio(); ?>
                <input type='text' value='<?= $precio; ?>' name='precio'> 
            <br>
            <label>Categoria</label>
            <select name="categoria">
                    <?php if($idCategoria == "1"){ ?>
                        <option value="1" selected>Bebidas</option>
                        <option value="2">Charcuteria</option>
                        <option value="3">Pescaderia</option>
                        <option value="4">Panaderia</option>
                    <?php }elseif($idCategoria == "2"){ ?>
                        <option value="1">Bebidas</option>
                        <option value="2" selected>Charcuteria</option>
                        <option value="3">Pescaderia</option>
                        <option value="4">Panaderia</option>
                    <?php }elseif($idCategoria == "3"){ ?>
                        <option value="1">Bebidas</option>
                        <option value="2">Charcuteria</option>
                        <option value="3" selected>Pescaderia</option>
                        <option value="4">Panaderia</option>
                    <?php }else{?>
                        <option value="1">Bebidas</option>
                        <option value="2">Charcuteria</option>
                        <option value="3">Pescaderia</option>
                        <option value="4" selected>Panaderia</option>
                    <?php } ?>
                    
            </select>
            <br>
            <input type="submit" value="Modificar" name="cambiar">
            <br>
            <input type="submit" value="Volver" name="volver">
            <br>
            <input type="submit" value="Salir" name="salir">
        </form>
    </body>
</html>
