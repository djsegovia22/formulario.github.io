<?php
$servername = "DESIGN";
$username = "root";  
$password = "";      
$dbname = "reportesDB";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id, nombre, email, tipo_reporte, descripcion, archivo, fecha FROM reportes ORDER BY fecha DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reportes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .reportes-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            overflow-y: scroll;
        }
        h2 {
            text-align: center;
        }
        .reporte {
            margin-bottom: 20px;
            padding: 15px;
            border-bottom: 1px solid #ccc;
        }
        .reporte:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="reportes-container">
        <h2>Todos los Reportes</h2>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='reporte'>";
                echo "<p><strong>Nombre:</strong> " . htmlspecialchars($row["nombre"]) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($row["email"]) . "</p>";
                echo "<p><strong>Tipo de Reporte:</strong> " . htmlspecialchars($row["tipo_reporte"]) . "</p>";
                echo "<p><strong>Descripción:</strong> " . htmlspecialchars($row["descripcion"]) . "</p>";
                echo "<p><strong>Fecha:</strong> " . $row["fecha"] . "</p>";
                if ($row["archivo"]) {
                    echo "<p><strong>Imagen:</strong> <a href='" . htmlspecialchars($row["archivo"]) . "' target='_blank'>Ver imagen</a></p>";
                }
                echo "</div>";
            }
        } else {
            echo "<p>No hay reportes disponibles.</p>";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </div>
</body>
</html>
