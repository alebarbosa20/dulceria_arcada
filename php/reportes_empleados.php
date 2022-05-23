<?php
require('..//fpdf.php');
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('..//img/logo.png',20,6,25);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Moverlo a la Derecha
    $this->Cell(65);
    // Titulo
    $this->Cell(155,10,'Reporte de Empleados',0,5,'C');
    // Salto de linea
    $this->Ln(20);
    $this->SetFont('Arial','B',14);
    $this->Cell(13,10, 'ID', 1, 0, 'C', 0);
    $this->Cell(35,10, 'Nombre', 1, 0, 'C', 0);    
    $this->Cell(45,10, 'Apellidos', 1, 0, 'C', 0);
    $this->Cell(30,10, utf8_decode('Teléfono'), 1, 0, 'C', 0);
    $this->Cell(28,10, utf8_decode('Ocupación'), 1, 0, 'C', 0);
    $this->Cell(105,10, utf8_decode('Dirección'), 1, 0, 'C', 0);
    $this->Cell(28,10, 'Fecha Nac', 1, 1, 'C', 0);

}

// Pagina footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Pagina number
    $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require '..//conexion.php';
$consulta = "select * from empleados";

$resultado = $conexion->query($consulta);


$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);


while ($row = $resultado->fetch_assoc()) {
	$pdf->Cell(13,10, utf8_decode($row['id']), 1, 0, 'C', 0);
    $pdf->Cell(35,10, utf8_decode($row['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(45,10, utf8_decode($row['apellidos']), 1, 0, 'C', 0);
    $pdf->Cell(30,10, utf8_decode($row['telefono']), 1, 0, 'C', 0);
    $pdf->Cell(28,10, utf8_decode($row['ocupacion']), 1, 0, 'C', 0);
    $pdf->Cell(105,10, utf8_decode($row['direccion']), 1, 0, 'C', 0);
    $pdf->Cell(28,10, utf8_decode($row['fecha_nac']), 1, 1, 'C', 0);

}


$pdf->Output();
?>

