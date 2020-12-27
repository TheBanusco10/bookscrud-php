<?php
require ('vendor/autoload.php');
require_once ('Model/PDF.php');
require_once ('Model/DB.php');
use Fpdf\Fpdf;

$pdf = new PDF();
$pdf->AddPage();
// First table: output all columns
$pdf->Table(DB::connect(), "select isbn, title, author, publisher from books LIMIT 10");
$pdf->Output();
