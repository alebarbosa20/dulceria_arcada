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
    $this->Cell(155,10,'Reporte de Productos',0,5,'C');
    // Salto de linea
    $this->Ln(20);
    $this->SetFont('Arial','B',14);
    $this->Cell(18,10, 'ID', 1, 0, 'C', 0);
    $this->Cell(45,10, 'Nombre', 1, 0, 'C', 0);    
    $this->Cell(130,10, utf8_decode('Descripción'), 1, 0, 'C', 0);
    $this->Cell(35,10, 'Categoria', 1, 0, 'C', 0);
    $this->Cell(25,10, 'Precio', 1, 0, 'C', 0);
    $this->Cell(28,10, 'Existencia', 1, 1, 'C', 0);

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
$consulta = "select * from productos";

$resultado = $conexion->query($consulta);


$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);


while ($row = $resultado->fetch_assoc()) {
	$pdf->Cell(18,10, utf8_decode($row['id']), 1, 0, 'C', 0);
    $pdf->Cell(45,10, utf8_decode($row['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(130,10, utf8_decode($row['descripcion']), 1, 0, 'C', 0);
    $pdf->Cell(35,10, utf8_decode($row['categoria']), 1, 0, 'C', 0);
    $pdf->Cell(25,10, utf8_decode($row['precio']), 1, 0, 'C', 0);
    $pdf->Cell(28,10, utf8_decode($row['existencia']), 1, 1, 'C', 0);

}


$pdf->Output();
?>

