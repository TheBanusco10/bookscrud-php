<?php
require ('vendor/autoload.php');
require_once ('Model/PDF.php');
require_once ('Model/DB.php');
use Fpdf\Fpdf;


$query = "select isbn, title, author, publisher from books ORDER BY $columnOrder $orderType LIMIT $offset, $maxRows";

$pdf = new PDF();
$pdf->AddPage();
$pdf->Table(DB::connect(), $query);
$pdf->Output();
