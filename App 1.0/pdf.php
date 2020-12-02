
<?php
require('/fpdf/fpdf.php');
class PDF extends FPDF
{
function Header()// Page Encabezado
	{		
	$this->Image('img\logo_blanco.png',20,10,20);// Logo
	$this->SetFont('Arial','B',15);// Arial bold 15
	$this->Cell(30);// Move to the right
	$this->Cell(10,10,"DESPACHO MISOL S.A. de C.V., El Sol de mi Dinero",0);// Title	
	$this->Ln(10);// Line break}
	
	$this->SetFont('Arial','I',10);// Arial bold 15
	$this->Cell(30);// Move to the right
	$this->Cell(0,5,"Aldama, Tamaulipas, Tel. (836) 274.1460 y 274.0221",0);// Title	
	$this->Ln(10);// Line break}
	
	
	}

function Footer()// Page Pie
	{
	$this->SetY(-15);// Position at 1.5 cm from bottom
	$this->SetFont('Arial','I',8);// Arial italic 8
	$this->Cell(0,10,'Pag '.$this->PageNo().'/{nb}',0,0,'C');// Page number
	}
}

// Instalacion de Clases
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter'); // p vertical, l horizontal

$pdf->SetFont('Times','',12);
$pdf-> cell(0,10,$nombresistema);

//for($i=1;$i<=40;$i++)
//	{$pdf->Cell(0,10,'Printing line number '.$i,0,1);}
$pdf->Output();





?>
