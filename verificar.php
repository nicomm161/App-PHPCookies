<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificació</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
        <!-- Mostrar usuari i data actual amb un ternari on actualitza si has iniciat sesio-->
<?php
    session_start();
    $ternari = isset($_SESSION['usuari']) ? $_SESSION['usuari'] : 'Invitat';
    $dataHoraActual = date('Y-m-d H:i:s');
    
    echo "<div id='cabecera'>";
    echo "<p>Benvingut, $ternari <br> data i hora actual: $dataHoraActual</p> ";
    echo "</div>";
?>
    <h2>Cookies Eliminades!</h2>
    <p>Les cookies s'han eliminat correctament.</p>
    <a href="privat.php">Tornar a la part privada</a>
</body>
</html>
