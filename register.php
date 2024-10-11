<?php
session_start();

if (!isset($_SESSION['drivers'])) {
    $_SESSION['drivers'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $driver = [
        'nombre' => $_POST['nombre'],
        'telefono' => $_POST['telefono'],
        'numero_trailer' => $_POST['numero_trailer'],
        'email' => $_POST['email'],
        'numero_orden' => $_POST['numero_orden'],
        'fecha_hora' => date('Y-m-d H:i:s')
    ];

    $_SESSION['drivers'][] = $driver;

    header('Location: index.html');
    exit();
}

if (isset($_GET['export']) && $_GET['export'] === 'pdf') {
    require('vendor/autoload.php'); // Asegúrate de tener la librería FPDF instalada

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Registro de Choferes');
    $pdf->Ln(10);
    
    foreach ($_SESSION['drivers'] as $driver) {
        $pdf->Cell(0, 10, implode(' | ', $driver), 0, 1);
    }

    $pdf->Output('D', 'choferes.pdf');
    exit();
}
?>
