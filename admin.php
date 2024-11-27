<?php
session_start();
require 'db.php';

// Verificar si el usuario es "Oscar" (usuario administrativo)
if (!isset($_SESSION['nombre']) || $_SESSION['nombre'] !== 'Oscar') {
    echo "<p style='text-align: center; color: red;'>Acceso denegado. Esta página es solo para administradores.</p>";
    exit;
}

// Obtener historial de compras desde la base de datos
$query = $conn->query("
    SELECT hc.id_compra, u.nombre AS usuario, p.nombre AS producto, hc.fecha_compra
    FROM historial_compras hc
    JOIN Usuarios u ON hc.id_usuario = u.id_usuario
    JOIN Productos p ON hc.id_producto = p.id_producto
    ORDER BY hc.fecha_compra DESC
");
$historial = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
    <h1>Panel de Administración</h1>
    <div class="admin-options">
        <a href="add_product.php" class="btn">Agregar Productos</a>
        <a href="edit_products.php" class="btn">Modificar Productos</a>
        <a href="logout.php" class="btn">Cerrar Sesión</a>
    </div>
</header>

<div class="admin-container">
    <h2>Historial de Compras</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID Compra</th>
                <th>Usuario</th>
                <th>Producto</th>
                <th>Fecha de Compra</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($historial)): ?>
                <?php foreach ($historial as $compra): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($compra['id_compra']); ?></td>
                        <td><?php echo htmlspecialchars($compra['usuario']); ?></td>
                        <td><?php echo htmlspecialchars($compra['producto']); ?></td>
                        <td><?php echo htmlspecialchars($compra['fecha_compra']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay registros en el historial de compras.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>