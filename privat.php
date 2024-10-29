<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privat</title>
    <link rel="stylesheet" href="css/styles.css">

</head>
<body>
    <h2>Benvingut a la part privada!</h2>
    <?php
    session_start();

    //Mostrar usuari i data actual amb un ternari on actualitza si has iniciat sesio
    $ternari = isset($_SESSION['usuari']) ? $_SESSION['usuari'] : 'Invitat';
    $dataHoraActual = date('Y-m-d H:i:s');

    // Mostrar la informacio del formulari extra on poses nom, cognom i email
    $nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';
    $cognom = isset($_SESSION['cognom']) ? $_SESSION['cognom'] : '';
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

    echo "<div id='cabecera'>";
    echo "<p>Benvingut, $ternari <br> data i hora actual: $dataHoraActual</p>";
    echo "<p>Nom: $nom <br> Cognom: $cognom <br> Email: $email</p>";
    echo "</div>";

    // Comprobacio de formulari per actualitzar les cookies
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualitzarCookies'])) {
        $nouUsuari = htmlspecialchars(trim($_POST['nouUsuari']));
        $novaContrasenya = htmlspecialchars(trim($_POST['novaContrasenya']));

        // Actualizar les cookies amb els nous valors 
        setcookie('usuari', $nouUsuari, time() + 300, "/"); 
        setcookie('contrasenya', $novaContrasenya, time() + 300, "/"); 

        echo "<p>Les cookies s'han actualitzat amb èxit!</p>";

        // Refrescar la pàgina per a que els canvis siguin visibles inmediatament
        header("Refresh:0");
    }

    // Comprobació de eliminació de cookies
    if (isset($_POST['eliminarCookies'])) {
    // Eliminar cookies     
	session_destroy(); // Destrueix la sessió
    setcookie('usuari', '', time() - 3600, "/"); // Actualitza i ja no hi ha informacio del usuari
    setcookie('contrasenya', '', time() - 3600, "/"); // Actualitza i ja no hi ha informacio de la contrasenya
    header("Location: verificar.php"); // Redirigir a la pàgina de verificació
    
    }

    // Comprobació de formulari per emmagatzemar altres dades personales
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardarDades'])) {
        $_SESSION['nom'] = htmlspecialchars(trim($_POST['nom']));
        $_SESSION['cognom'] = htmlspecialchars(trim($_POST['cognom']));
        $_SESSION['email'] = htmlspecialchars(trim($_POST['email']));
    }

    ?>
    <!-- Actualitzar Cookies -->
    <h2>Actualitzar Cookies:</h2>
    <form method="POST" action="">
        <label for="nouUsuari">Nou usuari:</label><br>
        <input type="text" id="nouUsuari" name="nouUsuari"><br><br>
        
        <label for="novaContrasenya">Nova contrasenya:</label><br>
        <input type="password" id="novaContrasenya" name="novaContrasenya"><br><br>
        
        <input type="submit" name="actualitzarCookies" value="Actualitzar Cookies">
    </form>
    <!-- Formulari de dades personals -->
    <h2>Dades Personals:</h2>
    <form method="POST" action="">
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom" ><br><br>

        <label for="cognom">Cognom:</label><br>
        <input type="text" id="cognom" name="cognom"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <input type="submit" name="guardarDades" value="Guardar Dades">
    </form>
    <!-- Botó eliminar cookies -->
    <h2>Eliminar Cookies:</h2>
    <form method="POST" action="">
        <input type="submit" name="eliminarCookies" value="Eliminar Cookies">
    </form>

    <p><a href="logout.php">Tancar sessió</a></p>

    <a href="aquari.php">Comprar productes en la nostra web d'aquaris</a>
    
</body>
</html>
