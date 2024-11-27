<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    try {
        $query = $conn->prepare("SELECT * FROM Usuarios WHERE correo = :correo");
        $query->bindParam(':correo', $correo);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id_usuario'] = $user['id_usuario'];
            $_SESSION['nombre'] = $user['nombre'];
            header('Location: index.php');
            exit;
        } else {
            echo "<p style='color: red;'>Correo o contraseña incorrectos.</p>";
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="form-login">
        <h1>Iniciar Sesión</h1>
        <form action="login.php" method="POST">
            <input type="email" name="correo" placeholder="Correo Electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="login">Iniciar Sesión</button>
        </form>
        <p>¿No tienes cuenta? <a href="registro.php">Crear una cuenta</a></p>
    </div>
</body>
</html>

