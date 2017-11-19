<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="palabra">
            <?php
            $solucionada = str_split($_SESSION['partida']->getSolucionada());
            $tamanio = strlen($_SESSION['partida']->getPalabra());
            echo"<h2>Palabra oculta: </h2>";          
            for($x=0;$x<$tamanio;$x++){          
                echo $solucionada[$x];
                echo" ";
            }  
            ?>
        </div>
        <br>
        <div id="usadas">
            <?php
            $usadas = str_split($_SESSION['partida']->getLetrasUsadas());         
            echo"<h2>Letras usadas: </h2>";
            for($x=0;$x<count($usadas);$x++){
                echo $usadas[$x];
                echo" ";
            }              
            ?>
        </div>
        <div id="intentos">
            <h1>Intentos:  <?php echo $_SESSION['partida']->getIntentos() ?>  </h1>  
        </div>
        <br>
        
        <div id="formulario">
            <?php
            echo"<form action='index.php' method='post'>";
            if($_SESSION['partida']->getAcabada()== false){
                echo"<h1>Encuentra la palabra</h1>";
                echo "<input type='text' name='letra'>";
                echo "<input type='submit' value='Jugar' name='jugar'>";
            }else{
                echo"<h1>Partida acabada</h1>";
            }
            echo "<input type='submit' value='Volver' name='volver'>";
            echo "<input type='submit' value='Salir' name='salir'>";
            echo"</form>";
            ?>          
        </div>
    </body>
</html>
