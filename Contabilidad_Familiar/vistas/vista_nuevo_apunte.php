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
        <h1> Contabilidad familiar</h1>
        <br>
        <h2> Nuevo apunte</h2>
        <br>
        <form action="index.php" method="POST">
            <label>Tipo apunte: </label>
            <select name="tipo">
                <option value="gasto">Gasto</option>
                <option value="ingreso">Ingreso</option>
            </select>
            <label>Concepto: </label>
            <input type="text" name="concepto">
            <br>
            <label>Cantidad: </label>
            <input type="number" name="cantidad">
            <br>
            <label>Fecha: </label>
            <input type="date" name="fecha">
            <br>
            <input type="submit" value="Guardar" name="guardar"> 
            <br>
            <input type="submit" value="Salir" name="salir">
        </form>
    </body>
</html>
