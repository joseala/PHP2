<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Bienvenido <?= $_SESSION['usuario']->getNombre()?> </h1>
        <h1>Bienvenido <?= $mensaje ?> </h1>
        <h1>Estas son las apuestas:</h1>
        <form action="index.php" method="POST">
            <table border="1">
                <thead>
                    <tr>
                        <th>Ref.Partido</th>
                        <th>Local</th>
                        <th>Visitante</th>
                        <th>Apuestas</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>0</td>
                        <td>Real Madrid</td>
                        <td>Valencia</td>
                        <td>
                            <select name="apuestas[0][resultado]">
                                <option value="0-0">0-0 a 2€ por 1€ </option>
                                <option value="0-1">0-1 a 3€ por 1€ </option>
                                <option value="1-0">1-0 a 1,5€ por 1€ </option>
                                <option value="1-1">1-1 a 2€ por 1€ </option>
                                <option value="2-1">2-1 a 1,5€ por 1€ </option>
                                <option value="1-2">1-2 a 3,5€ por 1€ </option>
                                <option value="2-2">2-2 a 1,5€ por 1€ </option>
                                <option value="3-1">3-1 a 2,5€ por 1€ </option>
                                <option value="1-3">1-3 a 5,5€ por 1€ </option>
                                <option value="3-2">3-2 a 1,5€ por 1€ </option>
                                <option value="2-3">2-3 a 4,5€ por 1€ </option>
                                <option value="3-3">3-3 a 3,5€ por 1€ </option>                                                                                               
                            </select>
                        </td>
                        <td><?php echo "<input type='number' name='apuestas[0][cantidad]' value='0' min='0'>"; ?></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Barcelona</td>
                        <td>Osasuna</td>
                        <td>
                            <select name="apuestas[1][resultado]">
                                <option value="0-0">0-0 a 2€ por 1€ </option>
                                <option value="0-1">0-1 a 3€ por 1€ </option>
                                <option value="1-0">1-0 a 1,5€ por 1€ </option>
                                <option value="1-1">1-1 a 2€ por 1€ </option>
                                <option value="2-1">2-1 a 5€ por 1€ </option>
                                <option value="1-2">1-2 a 3,5€ por 1€ </option>
                                <option value="2-2">2-2 a 1,5€ por 1€ </option>
                                <option value="3-1">3-1 a 2,5€ por 1€ </option>
                                <option value="1-3">1-3 a 5,5€ por 1€ </option>
                                <option value="3-2">3-2 a 1,5€ por 1€ </option>
                                <option value="2-3">2-3 a 4,5€ por 1€ </option>
                                <option value="3-3">3-3 a 3,5€ por 1€ </option>                                                                                             
                            </select>
                        </td>
                        <td><?php echo "<input type='number' name='apuestas[1][cantidad]' value='0' min='0'>"; ?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Sevilla</td>
                        <td>Malaga</td>
                        <td>
                            <select name="apuestas[2][resultado]">
                                <option value="0-0">0-0 a 2€ por 1€ </option>
                                <option value="0-1">0-1 a 3€ por 1€ </option>
                                <option value="1-0">1-0 a 1,5€ por 1€ </option>
                                <option value="1-1">1-1 a 2€ por 1€ </option>
                                <option value="2-1">2-1 a 1,5€ por 1€ </option>
                                <option value="1-2">1-2 a 3,5€ por 1€ </option>
                                <option value="2-2">2-2 a 1,5€ por 1€ </option>
                                <option value="3-1">3-1 a 2,5€ por 1€ </option>
                                <option value="1-3">1-3 a 5,5€ por 1€ </option>
                                <option value="3-2">3-2 a 3,5€ por 1€ </option>
                                <option value="2-3">2-3 a 4,5€ por 1€ </option>
                                <option value="3-3">3-3 a 3,5€ por 1€ </option>                                                                                             
                            </select>
                        </td>
                        <td><?php echo "<input type='number' name='apuestas[2][cantidad]' value='0' min='0'>"; ?></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Real Sociedad</td>
                        <td>Eibar</td>
                        <td>
                            <select name="apuestas[3][resultado]">
                                <option value="0-0">0-0 a 2€ por 1€ </option>
                                <option value="0-1">0-1 a 3€ por 1€ </option>
                                <option value="1-0">1-0 a 1,5€ por 1€ </option>
                                <option value="1-1">1-1 a 2€ por 1€ </option>
                                <option value="2-1">2-1 a 1,5€ por 1€ </option>
                                <option value="1-2">1-2 a 3,5€ por 1€ </option>
                                <option value="2-2">2-2 a 1,5€ por 1€ </option>
                                <option value="3-1">3-1 a 2,5€ por 1€ </option>
                                <option value="1-3">1-3 a 5,5€ por 1€ </option>
                                <option value="3-2">3-2 a 1,5€ por 1€ </option>
                                <option value="2-3">2-3 a 4,5€ por 1€ </option>
                                <option value="3-3">3-3 a 3,5€ por 1€ </option>                                                                                               
                            </select>
                        </td>
                        <td><?php echo "<input type='number' name='apuestas[3][cantidad]' value='0' min='0'>"; ?></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Leganes</td>
                        <td>Rayo Vallecano</td>
                        <td>
                            <select name="apuestas[4][resultado]">
                                <option value="0-0">0-0 a 2€ por 1€ </option>
                                <option value="0-1">0-1 a 3€ por 1€ </option>
                                <option value="1-0">1-0 a 1,5€ por 1€ </option>
                                <option value="1-1">1-1 a 2€ por 1€ </option>
                                <option value="2-1">2-1 a 1,5€ por 1€ </option>
                                <option value="1-2">1-2 a 3,5€ por 1€ </option>
                                <option value="2-2">2-2 a 1,5€ por 1€ </option>
                                <option value="3-1">3-1 a 2,5€ por 1€ </option>
                                <option value="1-3">1-3 a 4,5€ por 1€ </option>
                                <option value="3-2">3-2 a 1,5€ por 1€ </option>
                                <option value="2-3">2-3 a 4,5€ por 1€ </option>
                                <option value="3-3">3-3 a 3,5€ por 1€ </option>                                                                                               
                            </select>
                        </td>
                        <td><?php echo "<input type='number' name='apuestas[4][cantidad]' value='0' min='0'>"; ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <input type="submit" name="apostar" value="Apostar">
            <br>
            <input type="submit" name="resultado" value="Resultado">
            <br>
            <input type="submit" name="salir" value="Salir">
        </form>
    </body>
</html>
