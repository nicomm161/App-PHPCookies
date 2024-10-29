<?php
session_start();

session_unset();
// Destruir la sessió.
session_destroy();
// Eliminar la cookie de usuari, si existeix.
setcookie('usuari', '', time() - 3600, "/");

// Redirigir al usuari a la pàgina d'inici.
header("Location: index.php");

?>