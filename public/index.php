<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link href="../public/css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-8">Gestión de Productos</h1>
        <?php
            session_start();

            if (!isset($_SESSION['productos'])) {
                $_SESSION['productos'] = [];
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombre = $_POST['nombre'];
                $precio = $_POST['precio'];
                $cantidad = $_POST['cantidad'];

                agregarProducto($_SESSION['productos'], $nombre, $precio, $cantidad);
            }

            function agregarProducto(&$productos, $nombre, $precio, $cantidad) {
                $productos[] = [
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'cantidad' => $cantidad
                ];
            }

            function mostrarProductos($productos) {
                echo '<table class="table-auto w-full bg-white shadow-md rounded mb-8">';
                echo '<thead><tr class="bg-gray-200">';
                echo '<th class="px-4 py-2">Nombre del Producto</th>';
                echo '<th class="px-4 py-2">Precio por Unidad</th>';
                echo '<th class="px-4 py-2">Cantidad en Inventario</th>';
                echo '<th class="px-4 py-2">Valor Total</th>';
                echo '<th class="px-4 py-2">Estado</th>';
                echo '</tr></thead>';
                echo '<tbody>';

                foreach ($productos as $producto) {
                    $precio = floatval($producto['precio']);
                    $cantidad = intval($producto['cantidad']);
                    $valorTotal = $precio * $cantidad;
                    $estado = $cantidad == 0 ? 'Agotado' : 'En Stock';

                    echo '<tr>';
                    echo '<td class="border px-4 py-2">' . htmlspecialchars($producto['nombre']) . '</td>';
                    echo '<td class="border px-4 py-2">' . htmlspecialchars($precio) . '</td>';
                    echo '<td class="border px-4 py-2">' . htmlspecialchars($cantidad) . '</td>';
                    echo '<td class="border px-4 py-2">' . htmlspecialchars($valorTotal) . '</td>';
                    echo '<td class="border px-4 py-2">' . htmlspecialchars($estado) . '</td>';
                    echo '</tr>';
                }

                echo '</tbody></table>';
            }
        ?>

        <form action="" method="POST" class="mb-8 bg-white p-6 rounded shadow-md" id="productoForm">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                <p id="nombreError" class="text-red-500 text-sm mt-1"></p>
            </div>
            <div class="mb-4">
                <label for="precio" class="block text-gray-700">Precio por Unidad:</label>
                <input type="text" id="precio" name="precio" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                <p id="precioError" class="text-red-500 text-sm mt-1"></p>
            </div>
            <div class="mb-4">
                <label for="cantidad" class="block text-gray-700">Cantidad en Inventario:</label>
                <input type="text" id="cantidad" name="cantidad" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                <p id="cantidadError" class="text-red-500 text-sm mt-1"></p>
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Agregar Producto</button>
            </div>
        </form>

        <?php
            mostrarProductos($_SESSION['productos']);
        ?>
    </div>
    <script src="/public/js/validaciones.js" defer></script> <!-- Enlace al archivo JS -->
</body>
</html>
