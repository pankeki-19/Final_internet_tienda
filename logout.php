<?php
session_start();
session_destroy(); // Destruir toda la sesión
header('Location: index.php'); // Redirigir al inicio
exit;
?>
