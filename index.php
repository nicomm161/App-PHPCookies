<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">

    <title>Projecte M07UF1 - Nico Mesa</title>

    
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
    

// Si ya hi ha una sessió activa, redirigim directament a privat.php
if (isset($_SESSION['usuari'])) {
    header("Location: privat.php");
    
}
?>
<!-- Formulari per iniciar sesió -->

            <h1>Inici de sesió</h1>
            <form action="dades.php" method="post">
                
                
                    <label for="usuari">Usuari:</label><br>
                    <input type="text" id="usuari" name="usuari" required><br>
                

                
                
                    <label for="contrasenya">Contrasenya:</label><br>
                    <input type="password" id="contrasenya" name="contrasenya" required>
                

                
                
                    <input type="checkbox" id="checkbox" name="checkbox">
                    <label for="checkbox">Redorda la sessió</label>
                
                
                
                    <input type="submit" value="Enviar">
                
            </form>
        
</body>

</html>