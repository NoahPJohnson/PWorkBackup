<?php
require_once "fpdf.php";

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('times', 'B', 16);
$pdf->Cell(40,10,'Hello World');
$pdf->Output();
//echo "Hey";
?>