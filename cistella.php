<?php
session_start();

// Fem l'array associatiu dels nostres peixos
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

// Inicialitzem el carret si no està definit
if (!isset($_SESSION['cartellera'])) { 
    $_SESSION['cartellera'] = []; //Fem un array de carret on guardarem tots els productes i el ficarem en un foreach
    foreach ($aquari as $key => $animal) {
        $_SESSION['cartellera'][$key] = 0; // Inicialitzem cada producte amb quantitat 0 (fiquem els productes en el carret)
    }
}

// Fem la comprovació dels productes a més d'afegir la funció d'augmentar i restar al producte demanat
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $animal = $_POST['producte']; // Variable correcta per identificar l'animal
    if ($_POST['action'] === 'incrementar' && isset($_SESSION['cartellera'][$animal])) {
        $_SESSION['cartellera'][$animal]++; //Si dona al símbol + incrementa el producte de quantitat
    } elseif ($_POST['action'] === 'restar' && isset($_SESSION['cartellera'][$animal]) && $_SESSION['cartellera'][$animal] > 0) {
        $_SESSION['cartellera'][$animal]--; // Si li dona al botó de restar, resta els productes de la quantitat
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Cistella</title>
    <link rel="stylesheet" href="css/styles.css">

</head>
<body>
    <h1>Cistella de Compra</h1>

    <?php if (array_sum($_SESSION['cartellera']) > 0): // Comprova si hi ha algun producte al carret i el suma amb array sum?>
        <ul>
            <?php foreach ($_SESSION['cartellera'] as $key => $quantitat): ?> <!-- Recorrem un foreach per guardar-ho a la variable quantitat -->
                <?php if ($quantitat > 0): ?>
                    <!-- Fem una llista desordenada en HTML per els nostres productes -->
                    <li>
                        <!-- Retornem de la nostre key d'imatge de l'array associatiu perque passi per pantalla totes les imatges del nostre array-->
                        <img src="<?php echo $aquari[$key]['imatge']; ?>" alt="<?php echo $aquari[$key]['nom']; ?>"style="width: 100px; height: auto;">
                        <br>
                        <?php echo $aquari[$key]['nom']; ?> - Quantitat: <?php echo $quantitat; ?> <!-- Retornem el nom i la quantitat d'aquest producte -->
                        <br><br>
                        <form method="POST" style="display: inline;"> <!-- Poso l'estil inline per a que ocupi l'espai necesari -->
                            <input type="hidden" name="producte" value="<?php echo $key; ?>">
                            <br>
                            <!-- Botó per interactuar amb increment i restar productes -->
                            <button type="submit" name="action" value="incrementar">+</button>
                            <button type="submit" name="action" value="restar">-</button>
                            <br><br><br>
                        </form>
                    </li>
                <?php endif; ?> <!-- Sortim del condicional amb end if per tancar el condicional -->
            <?php endforeach; ?> <!-- Sortim del for each perque no es faci un bucle infinit -->
        </ul>
    <?php else: ?>
        <p>La cistella està buida.</p> <!-- I si no retorna que la cistella es buida-->
    <?php endif; ?>

    <a href="aquari.php">Tornar a la llista de productes</a> <!-- Tornem a la llista de productes -->
</body>
</html>

