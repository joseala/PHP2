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
        <table border="1" text-align="center">
                <thead>
                    <tr>
                        <th>Ref.Partido</th>
                        <th>Local</th>
                        <th>Visitante</th>
                        <th>Resultado</th>                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>0</td>
                        <td>Real Madrid</td>
                        <td>Valencia</td>
                        <td>
                            <?= $resultados[0]['resultado']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Barcelona</td>
                        <td>Osasuna</td>
                        <td>
                            <?= $resultados[1]['resultado']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Sevilla</td>
                        <td>Malaga</td>
                        <td>
                            <?= $resultados[2]['resultado']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Real Sociedad</td>
                        <td>Eibar</td>
                        <td>
                         <?= $resultados[3]['resultado']; ?>   
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Leganes</td>
                        <td>Rayo Vallecano</td>
                        <td>
                            <?= $resultados[4]['resultado']; ?>
                        </td>                     
                    </tr>
                </tbody>
            </table>
        <br>
        <table border="1" text-align="center">
            <thead>
                <tr>
                    <th>Id Partido</th>
                    <th>Resultado</th>
                    <th>Apuesta</th>
                    <th>Premio Apuesta</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($premios as $y => $apuesta) { ?>     
                <tr>
                    <td><?= $y;?></td>
                    <td><?= $apuesta['resultado'];?></td>
                    <td><?= $apuesta['apuesta'];?></td>
                    <td><?= $apuesta['premio'];?></td>
                </tr>
                
                <?php 
                    $total +=$apuesta['premio'];
                } ?>
                <tr>
                    <td></td>
                    <td>Total Premios</td>
                    <td><?= $total;?></td>
                </tr>
            </tbody>
        </table>
    </body>
    <form action="index.php" method="POST">
        <input type="submit" name="cobrar" value="Cobrar">
        <input type="submit" name="salirApuestas" value="Salir">
    </form>
</html>
