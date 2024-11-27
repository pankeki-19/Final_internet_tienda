<?php
session_start();
require 'db.php';

// Verificar si el usuario es "Oscar"
if (!isset($_SESSION['nombre']) || $_SESSION['nombre'] !== 'Oscar') {
    echo "<p style='text-align: center; color: red;'>Acceso denegado.</p>";
    exit;
}

// Verificar si se pasó el ID del producto
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p style='text-align: center; color: red;'>ID de producto no especificado.</p>";
    exit;
}

$id_producto = intval($_GET['id']); // Convertir a entero para evitar problemas de seguridad

// Obtener los datos del producto
$query = $conn->prepare("SELECT * FROM Productos WHERE id_producto = ?");
$query->execute([$id_producto]);
$producto = $query->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    echo "<p style='text-align: center; color: red;'>Producto no encontrado.</p>";
    exit;
}

// Procesar el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];

    // Actualizar los datos del producto en la base de datos
    $stmt = $conn->prepare("UPDATE Productos SET nombre = ?, precio = ?, description = ? WHERE id_producto = ?");
    $stmt->execute([$nombre, $precio, $descripcion, $id_producto]);

    echo "<p style='text-align: center; color: green;'>Producto actualizado con éxito.</p>";
    // Redirigir de nuevo a la lista de productos
    header("Location: edit_products.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
    <h1>Editar Producto</h1>
    <a href="edit_products.php" class="btn">Volver a Productos</a>
</header>

<div class="form-container">
    <form method="POST" action="">
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" placeholder="Nombre del Producto" required>
        <input type="number" step="0.01" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" placeholder="Precio" required>
        <textarea name="descripcion" placeholder="Descripción del Producto" required><?php echo htmlspecialchars($producto['description']); ?></textarea>
        <button type="submit" class="btn">Guardar Cambios</button>
    </form>
</div>
</body>
</html>