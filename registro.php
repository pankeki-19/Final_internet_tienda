<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $num_tarjeta = $_POST['num_tarjeta'];
    $cod_postal = $_POST['cod_postal'];

    try {
        $query = $conn->prepare("INSERT INTO Usuarios (nombre, correo, password, fecha_nacimiento, num_tarjeta, cod_postal) 
                                 VALUES (:nombre, :correo, :password, :fecha_nacimiento, :num_tarjeta, :cod_postal)");
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':correo', $correo);
        $query->bindParam(':password', $password);
        $query->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $query->bindParam(':num_tarjeta', $num_tarjeta);
        $query->bindParam(':cod_postal', $cod_postal);

        $query->execute();
        echo "<p style='color: green;'>¡Registro exitoso! Ahora puedes iniciar sesión.</p>";
        echo "<p><a href='login.php'>Ir al login</a></p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Error al registrar el usuario: " . $e->getMessage() . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Crear Cuenta</title>
</head>
<body>
    <div class="form-register">
        <h1>Crear Cuenta</h1>
        <form action="registro.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="email" name="correo" placeholder="Correo Electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="date" name="fecha_nacimiento" required>
            <input type="text" name="num_tarjeta" placeholder="Número de Tarjeta" required>
            <input type="text" name="cod_postal" placeholder="Código Postal" required>
            <button type="submit" name="registro">Crear Cuenta</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia Sesión</a></p>
    </div>
</body>
</html>
