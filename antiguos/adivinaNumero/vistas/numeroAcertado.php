<?php
echo "<h1>Has adivinado el numero secreto</h1>";
echo "<h1>Numero secreto </h1>".$_SESSION['partida']->getAleatorio();
echo "<h1>Numero de intentos </h1>".$_SESSION['partida']->getIntentos();
echo"<form id='formulario' method='POST' action='index.php'>";
echo "<input type='submit' value='volver a jugar' name='volver'>";
echo"</form>";
?>

