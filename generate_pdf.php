<?php
include 'fpdf.php';

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "aveymas";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$sql = "SELECT id, description, due_date, additional_notes, created_at FROM tareas ORDER BY due_date ASC";
$result = $conn->query($sql);

$pdf = new FPDF();
$pdf->AddPage();

//IMAGEN EMPRESARIAL
$pdf->Image('images/logo.png', 10, 10, 50);

//ESPACIO
$pdf->Ln(40);
$pdf->SetFont('Arial', 'B', 16);

// Título del PDF
$pdf->Cell(0, 10, 'Lista de Tareas Pendientes IT', 0, 1, 'C');

// Establecer fuente para el contenido
$pdf->SetFont('Arial', '', 12);

//COLOR DE LAS CABECERAS


// Verificar si hay tareas
if ($result->num_rows > 0) {
    // Cabeceras de tabla
    $pdf->Cell(10, 10, 'ID', 1);
    $pdf->Cell(80, 10, 'Descripcion', 1);
    $pdf->Cell(30, 10, 'Fecha', 1);
    $pdf->Cell(70, 10, 'Notas Adicionales', 1);
    $pdf->Ln();

    // Contenido de tareas
    while($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $row["id"], 1);
        $pdf->Cell(80, 10, $row["description"], 1);
        $pdf->Cell(30, 10, $row["due_date"], 1);
        $pdf->Cell(70, 10, $row["additional_notes"], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No hay tareas disponibles.', 0, 1, 'C');
}

// Cerrar la conexión
$conn->close();

// Enviar el PDF al navegador
$pdf->Output('D', 'tareas_pendientes.pdf');
?>
