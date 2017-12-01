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
        <?php
        echo "<form action='index.php' method='post'>";
        echo "<table>";
        $x = 0;
        while($partido = $jornada->getpartidos()->iterate()){        
            echo "<tr>";
            echo "<td><input type='hidden' value='".$partido->getId()."' name='resultados[$x][id]'><input type='hidden' name='resultados[$x][eqL]' value='".$partido->getEquipoL()."'>".$_SESSION['liga']->getEquipos()->getByProperty("id", $partido->getEquipoL())->getNombre()."</td>";
            if($partido->getEquipoL() == $_SESSION['descanso']->getId() || $partido->getEquipoV()== $_SESSION['descanso']->getId()){
                 echo "<td><input type='text' readonly value='descanso' name='resultados[$x][gL]'></td>";
            }else{
                echo "<td><input type='number' value='".$partido->getGV()."' name='resultados[$x][gL]'></td>";
            }
            
            echo "<td><input type='hidden' name='resultados[$x][eqV]' value='".$partido->getEquipoV()."'>".$_SESSION['liga']->getEquipos()->getByProperty("id", $partido->getEquipoV())->getNombre()."</td>";
            if($partido->getEquipoL()== $_SESSION['descanso']->getId() || $partido->getEquipoV()== $_SESSION['descanso']->getId()){
                 echo "<td><input type='text' readonly value='descanso' name='resultados[$x][gV]'></td>";
            }else{
                echo "<td><input type='number' value='".$partido->getGL()."'name='resultados[$x][gV]'></td>";
            }
            
            echo "</tr>";
            $x++;
        }
        echo"</table>";
        echo "<td><input type='hidden' value='".$idJornada."'name='id'></td>";
        echo "<input type='submit' value='Guargar' name='guardar'>";
        echo "<input type='submit' value='Volver' name='volver'>";
        echo "</form>";
        ?>
    </body>
</html>
