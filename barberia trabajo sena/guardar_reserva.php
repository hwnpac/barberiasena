<?php
// Datos de conexión a MySQL (ajusta si tu usuario/contraseña son diferentes)
$host = "localhost";
$user = "root";      // usuario por defecto en XAMPP
$pass = "";          // contraseña por defecto en XAMPP está vacía
$dbname = "barberia";

// Conectar a la base de datos
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servicio = $_POST["servicio"];
    $barbero  = $_POST["barbero"];
    $fecha    = $_POST["fecha"];
    $hora     = $_POST["hora"];

    // Preparar consulta SQL
    $sql = "INSERT INTO reservas (servicio, barbero, fecha, hora) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $servicio, $barbero, $fecha, $hora);

    if ($stmt->execute()) {
        echo "<h2>✅ Reserva guardada con éxito</h2>";
        echo "<p><a href='reserva.html'>Volver al formulario</a></p>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
