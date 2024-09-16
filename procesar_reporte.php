<?php

$servername = "DESIGN";
$username = "root"; 
$password = "";      
$dbname = "reportesbd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $tipo_reporte = $_POST['tipo_reporte'];
    $descripcion = $_POST['descripcion'];

    $archivo = "";
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $directorio_destino = 'uploads/';
        $nombre_archivo = basename($_FILES['archivo']['name']);
        $ruta_archivo = $directorio_destino . $nombre_archivo;

        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta_archivo)) {
            $archivo = $ruta_archivo;
        }
    }

    $stmt = $conn->prepare("INSERT INTO reportes (nombre, tipo_reporte, descripcion, archivo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $email, $tipo_reporte, $descripcion, $archivo);

    if ($stmt->execute()) {
        echo "Reporte enviado con éxito.";
    } else {
        echo "Error al enviar el reporte: " . $stmt->error;
    }

 
    $stmt->close();
    $conn->close();
} else {
    echo "Método no permitido.";
}
?>
