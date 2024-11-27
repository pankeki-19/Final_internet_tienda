<?php
$host = 'localhost'; // Para XAMPP, usa localhost
$dbname = 'tienda_online'; // Nombre de tu base de datos
$username = 'root'; // Usuario predeterminado de XAMPP
$password = ''; // Contraseña predeterminada (vacía en XAMPP)

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error al conectar con la base de datos: ' . $e->getMessage());
}
?>
