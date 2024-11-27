<?php
session_start();
require 'db.php';

// Verificar si el usuario está autenticado
$isAuthenticated = isset($_SESSION['id_usuario']);
$nombreUsuario = $isAuthenticated ? $_SESSION['nombre'] : null;

// Procesar la compra
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comprar'])) {
    if ($isAuthenticated) {
        // Obtener el id del usuario
        $id_usuario = $_SESSION['id_usuario'];
        $fecha_compra = date('Y-m-d H:i:s'); // Fecha actual

        try {
            $conn->beginTransaction(); // Iniciar la transacción

            foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
                for ($i = 0; $i < $cantidad; $i++) {
                    // Insertar en historial_compras
                    $stmtHistorial = $conn->prepare("INSERT INTO historial_compras (id_usuario, id_producto, fecha_compra) VALUES (?, ?, ?)");
                    $stmtHistorial->execute([$id_usuario, $id_producto, $fecha_compra]);

                    // Insertar en carrito_compras
                    $stmtCarrito = $conn->prepare("INSERT INTO carrito_compras (id_usuario, id_producto) VALUES (?, ?)");
                    $stmtCarrito->execute([$id_usuario, $id_producto]);
                }
            }

            $conn->commit(); // Confirmar la transacción

            // Vaciar el carrito después de la compra
            $_SESSION['carrito'] = [];

            // Mostrar mensaje de éxito
            echo "<p style='text-align: center; font-size: 20px; color: green;'>
                    Muchas gracias por tu compra, <strong>" . htmlspecialchars($nombreUsuario) . "</strong>.
                  </p>";
        } catch (Exception $e) {
            $conn->rollBack(); // Revertir la transacción en caso de error
            echo "<p style='text-align: center; font-size: 20px; color: red;'>
                    Ocurrió un error al procesar tu compra. Por favor, inténtalo de nuevo.
                  </p>";
        }
    } else {
        // Redirigir al inicio de sesión si no está autenticado
        header('Location: login.php?redirect=carrito');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Carrito de Compras</title>
</head>
<body>
<header>
    <div class="header-container">
        <h1>Carrito de Compras</h1>
        <div class="header-buttons">
            <a href="index.php" class="btn">Volver a la Tienda</a>
            <?php
            if ($isAuthenticated) {
                echo "<span>Bienvenido, " . htmlspecialchars($nombreUsuario) . "</span>";
                echo "<a href='logout.php' class='btn'>Cerrar Sesión</a>";
            } else {
                echo "<a href='login.php' class='btn'>Iniciar Sesión</a>";
            }
            ?>
        </div>
    </div>
</header>
<div class="cart-container">
    <h2>Tu Carrito</h2>
    <table class="cart-table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;

            if (!empty($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
                    // Obtener información del producto desde la base de datos
                    $query = $conn->prepare("SELECT * FROM Productos WHERE id_producto = ?");
                    $query->execute([$id_producto]);
                    $producto = $query->fetch(PDO::FETCH_ASSOC);

                    if ($producto) {
                        // Calcular subtotal
                        $subtotal = $producto['precio'] * $cantidad;
                        $total += $subtotal;

                        echo "
                            <tr>
                                <td>" . htmlspecialchars($producto['nombre']) . "</td>
                                <td>" . htmlspecialchars($cantidad) . "</td>
                                <td>$" . number_format($producto['precio'], 2) . "</td>
                                <td>$" . number_format($subtotal, 2) . "</td>
                                <td>
                                    <form method='POST' action='carrito.php'>
                                        <input type='hidden' name='id_producto' value='" . $id_producto . "'>
                                        <button type='submit' name='remove_from_cart' class='btn'>Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        ";
                    }
                }
                echo "
                    <tr>
                        <td colspan='3'><strong>Total</strong></td>
                        <td><strong>$" . number_format($total, 2) . "</strong></td>
                        <td></td>
                    </tr>
                ";
            } else {
                echo "<tr><td colspan='5'>Tu carrito está vacío.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="cart-actions">
        <?php if (!empty($_SESSION['carrito'])): ?>
            <form method="POST" action="carrito.php">
                <button type="submit" name="comprar" class="btn">Comprar</button>
            </form>
        <?php endif; ?>
        <a href="index.php" class="btn">Seguir Comprando</a>
    </div>
</div>
</body>
</html>