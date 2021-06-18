<?php

require_once("/var/www/html/TCPDF-main/tcpdf.php");

$ref = filter_input(INPUT_POST, "referencia", FILTER_SANITIZE_STRING);
$text = filter_input(INPUT_POST, "text_pdf", FILTER_SANITIZE_STRING);

class MYPDF extends TCPDF {

    protected $regularFont = "Helvetica";

    //Construct
    public function __construct() {
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->SetFont($this->regularFont, '', 9);
    }
    //Page header
    public function Header() 
    {
        
    }

    // Page footer
    public function Footer() 
    {
        
    }
}


$pdf = new MYPDF();

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('VL');
$pdf->SetTitle('VL');
$pdf->SetSubject('VL');
$pdf->SetKeywords('VL');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage();

$x = 10;
$y = 10;
$pdf->MultiCell(190, 14, $text, 0, 'L', false, 1, $x, $y, true);


$str = str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlNnMmOoPpQqRrSsTtUuVvWwYyZz0123456789");
$ct = time();

$file = "F" . $ref . "_" . $ct . "_" . $str .".pdf"; 
$pdf->Output('/var/www/pdfs/'.$file, 'FI');

//Guardamos los datos
$pdo = new PDO('mysql:host=localhost;dbname=bbdd_pdf;charset=utf8','root', '****');
$sql_insert_file = "INSERT INTO bbdd_pdf.file_pdf (referencia, fichero) VALUES (?,?)";
$smt_insert_file = $pdo->prepare($sql_insert_file);
$smt_insert_file->execute(array($ref,$file));
//Fin guardar los datos

return;
