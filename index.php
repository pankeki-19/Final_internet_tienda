<?php
session_start();
require 'db.php';

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Procesar el formulario de "Añadir al Carrito"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 1;

    // Verificar si el producto ya está en el carrito
    if (isset($_SESSION['carrito'][$id_producto])) {
        $_SESSION['carrito'][$id_producto] += $cantidad;
    } else {
        $_SESSION['carrito'][$id_producto] = $cantidad;
    }

    // Redirigir al carrito después de añadir
    header('Location: carrito.php');
    exit;
}
?>


<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Comete un pan!!!</title>
</head>
<body>
<header>
    <div class="header-container">
        <h1>Panadería!!</h1>
        <div class="header-buttons">
            <?php
            // Mostrar nombre del usuario si está autenticado
            if (isset($_SESSION['id_usuario'])) {
                echo "<span>Bienvenido, " . htmlspecialchars($_SESSION['nombre']) . "</span>";
                echo "<a href='logout.php' class='btn'>Cerrar Sesión</a>";
            } else {
                echo "<a href='login.php' class='btn'>Iniciar Sesión</a>";
            }
            ?>
            <a href="carrito.php" class="btn">Carrito</a>
        </div>
    </div>
</header>
<div class="container">
    <h2>PAN!!!</h2>
        <div class="product-grid">
        <?php
        $query = $conn->query("SELECT * FROM Productos LIMIT 30");

        while ($producto = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "
                <div class='product-card'>
                    <div class='product-image'>
                        <img src='" . htmlspecialchars($producto['fotos']) . "' alt='" . htmlspecialchars($producto['nombre']) . "'>
                    </div>
                    <div class='product-info'>
                        <h3>" . htmlspecialchars($producto['nombre']) . "</h3>
                        <p class='price'>$" . number_format($producto['precio'], 2) . "</p>
                        <form action='index.php' method='POST'>
                            <input type='hidden' name='id_producto' value='" . $producto['id_producto'] . "'>
                            <input type='hidden' name='cantidad' value='1'>
                            <button type='submit' name='add_to_cart' class='btn btn-add-cart'>Añadir al Carrito</button>
                        </form>
                    </div>
                    <div class='product-description'>
                        <p>" . htmlspecialchars($producto['description']) . "</p>
                    </div>
                </div>
            ";
        }
        ?>
    </div>
</div>
<?php if (isset($_SESSION['nombre']) && $_SESSION['nombre'] === 'Oscar'): ?>
    <div class="footer-btn">
        <a href="admin.php" class="btn">Administración</a>
    </div>
<?php endif; ?>
<!-- //Botón para administrativos -->
<?php if (isset($_SESSION['nombre']) && $_SESSION['nombre'] === 'Oscar'): ?>
    <div class="footer-btn">
        <a href="add_product.php">Añadir Producto</a>
    </div>
<?php endif; ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Seleccionar todas las tarjetas
            const productCards = document.querySelectorAll(".product-card");

            productCards.forEach(card => {
                // Agregar evento de clic a cada tarjeta
                card.addEventListener("click", (event) => {
                    // Evitar que el clic en el botón "Añadir al Carrito" active la descripción
                    if (event.target.tagName === "BUTTON" || event.target.closest("form")) {
                        return;
                    }

                    // Alternar la clase 'active' para mostrar/ocultar la descripción
                    card.classList.toggle("active");
                });
            });
        });
    </script>
</body>
</html>