<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $fabricante = $_POST['fabricante'];
    $origen = $_POST['origen'];
    $foto = '';

    // Subir la imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $foto = 'uploads/' . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
    }

    try {
        // Insertar el producto en la base de datos
        $query = $conn->prepare("INSERT INTO Productos (nombre, description, fotos, precio, cantidad_almacen, fabricante, origen) 
                                 VALUES (:nombre, :descripcion, :foto, :precio, :cantidad, :fabricante, :origen)");
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':descripcion', $descripcion);
        $query->bindParam(':foto', $foto);
        $query->bindParam(':precio', $precio);
        $query->bindParam(':cantidad', $cantidad);
        $query->bindParam(':fabricante', $fabricante);
        $query->bindParam(':origen', $origen);

        $query->execute();
        echo "<p style='color: green;'>Producto añadido exitosamente.</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Error al añadir producto: " . $e->getMessage() . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Añadir Producto</title>
</head>
<body>
    <div class="container">
        <h1>Añadir Producto</h1>
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Nombre del Producto" required>
            <textarea name="descripcion" placeholder="Descripción del Producto" required></textarea>
            <input type="number" step="0.01" name="precio" placeholder="Precio" required>
            <input type="number" name="cantidad" placeholder="Cantidad en Inventario" required>
            <input type="text" name="fabricante" placeholder="Fabricante" required>
            <input type="text" name="origen" placeholder="Origen" required>
            <input type="file" name="foto" accept="image/*" required>
            <button type="submit" name="add_product">Añadir Producto</button>
        </form>
        <p><a href="index.php">Volver a la Tienda</a></p>
    </div>
</body>
</html>
