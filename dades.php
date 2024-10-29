
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dades</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h2>Benvingut a la part de dades!</h2>
<?php
//Iniciem sesió
session_start();
//Mostrar usuari i data actual amb un ternari on actualitza si has iniciat sesio
$ternari = isset($_SESSION['usuari']) ? $_SESSION['usuari'] : 'Invitat';
$dataHoraActual = date('Y-m-d H:i:s');
//Imprimir resultat
echo "<div id='cabecera'>";
echo "<p>Benvingut, $ternari <br> data i hora actual: $dataHoraActual</p> ";
echo "</div>";

//Aquest condicional comproba la solicitud al servidor
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //les etiquetes "htmlspecialchars" converteix els caracters especials en entitats HTML i "trim" elimina els espais
    $usuari = htmlspecialchars(trim($_POST['usuari']));
    $contrasenya = htmlspecialchars(trim($_POST['contrasenya']));
    $checkbox = isset($_POST['checkbox']) ? $_POST['checkbox'] : '';

    //Usuari i contrasenya correctes
    $usuariCorrecte = "nico"; 
    $contrasenyaCorrecta = "12345"; 

    //Condicional on validem si el usuari que escribim en el formulari es igual que el constant
    if ($usuari == $usuariCorrecte && $contrasenya == $contrasenyaCorrecta) {
        

        
        $_SESSION['usuari'] = $usuari;

        //Si checkbox de recorda es marca es guardan les cookies 5 minuts
        if (!empty($checkbox)) {
            
            setcookie('usuari', $usuari, time() + 300, "/"); 
        } else {
            //Si no la cookie desapareix
            setcookie('usuari', '', time() - 3600, "/");
        }
        

        //Redireccio a la web privat (aplicacio)
        header("Location: privat.php");
        
    } else {
        //Si no redirigeix a la mateixa pagina amb un link on pots tornar al formulari d'inici
        echo "<br>";
        echo "Usuari o contrasenya incorrectes. <br>";
        echo "<br>";
        echo "<a href='index.php'>Tornar a la pàgina d'inici</a>";
    }
}
?>
</body>
</html>