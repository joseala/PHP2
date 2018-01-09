<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Administración de grupos </h1>
        <br> 
        <form action="index.php" method="POST">
            <?php foreach ($grupos as $grupo) { ?>
            <h4><input type='radio' value='<?= $grupo->getId();?>' name='id'>___<?= $grupo->getNombre();?> </h4>
            <br>    
            <?php }?>
            <input type="submit" value="Ver" name="ver">
            <br>
            <input type="submit" value="Salir" name="salir">
        </form>
    </body>
</html>
