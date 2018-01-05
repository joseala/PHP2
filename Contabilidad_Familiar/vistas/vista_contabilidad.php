<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1> AppWeb contabilidad familiar</h1>
        <br>
        <table border="1">
            <thead>
                <tr>
                    <th>REF.</th>
                    <th>FECHA</th>
                    <th>CONCEPTO</th>
                    <th>CANTIDAD</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($filtrado)){ ?>    
                    <?php foreach($filtrado as $apunte){ ?>
                    <tr>
                        <td><?= $apunte['id']; ?></td>
                        <td><?= $apunte['fecha'] ?></td>
                        <td><?= $apunte['concepto']; ?></td>
                        <td><?= $apunte['cantidad']; ?></td>
                     </tr>
                     
                    <?php } ?>  
                <?php }else{ ?> 
                    <?php while ($apunte = $usuario->getApuntes()->iterate()){ ?>
                    <tr>
                        <td><?= $apunte->getId(); ?></td>
                        <td><?= $apunte->getFecha(); ?></td>
                        <td><?= $apunte->getConcepto(); ?></td>
                        <td><?= $apunte->getCantidad(); ?></td>
                     </tr>
                    <?php } ?>  
                <?php } ?>
                <tr>
                    <td><h1>TO</h1></td>
                    <td><h1>TA</h1></td>
                    <td><h1>L</h1></td>
                    <td><?= $total; ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <form action="index.php" method="POST">
            <label>Desde: </label>
            <input type="date" name="desde">
            <br>
            <label>Hasta: </label>
            <input type="date" name="hasta">
            <br>
            <label><input type="radio" value="gasto" name="tipo"> Gastos </label>
            <label><input type="radio" value="ingreso" name="tipo"> Ingresos </label>
            <br>
            <input type="submit" value="Filtrar" name="filtrar">
            <br>
            <input type="submit" value="Nuevo apunte" name="nuevo"> 
            <br>
            <input type="submit" value="Total" name="total">
            <?php if(isset($_SESSION['filtrado'])){ ?>
            <br>
            <input type="submit" value="Volver" name="volver">
            <?php } ?>
            <br>
            <input type="submit" value="Salir" name="salir">
        </form>
    </body>
</html>
