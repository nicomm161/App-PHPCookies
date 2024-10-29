<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquari</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h2>Benvingut a la web d'aquaris on venem els següents animals:</h2>

    <?php
        session_start();

        // Mostrar usuari i data actual amb un ternari on actualitza si has iniciat sessió
        $usuari = isset($_SESSION['usuari']) ? $_SESSION['usuari'] : 'Invitat';
        $dataHoraActual = date('Y-m-d H:i:s');
        echo "<p>Usuari: $usuari</p>";
        echo "<p>Data i hora actual: $dataHoraActual</p>";

        if (!isset($_SESSION['cartellera'])) {
            $_SESSION['cartellera'] = []; // Inicialitza la cistella si no existeix
        }

        // Array associatiu d'animals de l'aquari amb imatges
        $aquari = [
            'animal1' => ['nom' => 'Peixos de colors', 'preu' => 10, 'imatge' => 'images/peix-de-colors.jpg'],
            'animal2' => ['nom' => 'Guppies', 'preu' => 8, 'imatge' => 'images/guppie.jpg'],
            'animal3' => ['nom' => 'Peix pallasso', 'preu' => 25, 'imatge' => 'images/paix-payaso.jpg'],
            'animal4' => ['nom' => 'Tetras Neó', 'preu' => 5, 'imatge' => 'images/tetras-neo.jpg'],
            'animal5' => ['nom' => 'Peix cirurgià blau', 'preu' => 30, 'imatge' => 'images/peix-cirurgia.jpg'],
            'animal6' => ['nom' => 'Betta Splendens', 'preu' => 12, 'imatge' => 'images/Betta-splendens.jpg'],
            'animal7' => ['nom' => 'Cavallet de mar', 'preu' => 40, 'imatge' => 'images/cavallet-mediterrani.jpg'],
            'animal8' => ['nom' => 'Estrella de mar', 'preu' => 18, 'imatge' => 'images/estrella-de-mar.jpg'],
            'animal9' => ['nom' => 'Gamba netejadora', 'preu' => 15, 'imatge' => 'images/gamba-de-pebrera.jpg'],
            'animal10' => ['nom' => 'Garota de mar', 'preu' => 22, 'imatge' => 'images/garota-de-mar.jpg']
        ];

        // Afegir productes a la cistella
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['producte'])) {
            $producte = $_POST['producte']; //Afegim els productes a la variable producte
            if (isset($aquari[$producte])) { //Comprovem que hi hagin productes
                if (!isset($_SESSION['cartellera'][$producte])) {
                    $_SESSION['cartellera'][$producte] = 0; //Si no hi ha productes retorna un 0
                }
                $_SESSION['cartellera'][$producte]++; //Si el producte ja existeix retorna 1
            }
        }
    ?>

    <!-- Productes a demanar -->
    <!-- Fem una taula -->
    <table border="1">
    <thead>
        <tr>
            <!-- Capçalera amb els titols -->
            <th>Imatge</th>
            <th>Nom</th>
            <th>Preu</th>
            <th>Comprar</th>
        </tr>
    </thead>
    <tbody>
        <!-- Fem un foreach per imprimir en metode de taula els productes -->
        <?php foreach ($aquari as $key => $producte): ?>
            <tr>
                <!-- Posem en cada cel.la la imatge, nom i preu en el seu ordre dels titols -->
                <td><img src="<?php echo $producte['imatge']; ?>" alt="<?php echo $producte['nom']; ?>" style="width: 100px; height: auto;"></td>
                <td><?php echo $producte['nom']; ?></td>
                <td>€<?php echo $producte['preu']; ?></td>
                <td>
                    <!-- Fem que en el titol comprar posem un botó que es demana -->
                    <form method="POST">
                        <!-- Li donem com valor el producte per redirigir al nostre producte en aquest cas -->
                        <input type="hidden" name="producte" value="<?php echo $key; ?>">
                        <button type="submit">Demana</button>
                    </form>
                </td>
            </tr>
            <!-- Una vegada recorreguts els productes sortim del foreach -->
        <?php endforeach; ?>
    </tbody>
</table>

    
    <!-- Redirigeix a la cistella -->
    <a href="cistella.php">Veure cistella</a>
</body>
</html>



