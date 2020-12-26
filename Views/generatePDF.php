<?php

require ('Model/DB.php');
require ('Model/PDF.php');


$pdf = new PDF();
// First table: output all columns
$pdf->Table(DB::connect(), 'select * from books LIMIT 5;');
$pdf->AddPage();