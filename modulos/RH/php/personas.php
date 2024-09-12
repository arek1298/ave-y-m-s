<?php
$area_id = $_GET['area'];
$conn = new mysqli('localhost', 'root', '', 'aveymas');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id, nombre FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $area_id);
$stmt->execute();
$result = $stmt->get_result();

$personas = [];
while ($row = $result->fetch_assoc()) {
    $personas[] = $row;
}

header('Content-Type: application/json');
echo json_encode($personas);

$stmt->close();
$conn->close();
?>
