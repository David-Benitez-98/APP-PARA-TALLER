<?php

include_once 'config/tcpdf/tcpdf.php';
include_once 'config/database.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 0, 'Pag. ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

}

// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('David Benitez');
$pdf->SetTitle('REPORTE DE ORDEN DE  COMPRA');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins POR DEFECTO
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8,10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks SALTO AUTOMATICO Y MARGEN INFERIOR
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


// ---------------------------------------------------------
// TIPO DE LETRA
$pdf->SetFont('times', 'B', 14);

// AGREGAR PAGINA
$pdf->AddPage('L', 'LEGAL');
//celda para titulo
$pdf->Cell(0, 0, "REPORTE DE ORDEN DE COMPRAS", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();

//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);


//$pdf->Ln(); //salto
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);





//consulta a la base de datos
$ordens = consultas::get_datos("select * from v_ordencompra "
                . "where cod_ord_compra=" . $_REQUEST['vcod'] . " order by cod_ord_compra");

if (!empty($ordens)) {

    foreach ($ordens as $orden) {
        $pdf->SetFont('', 'B', 10);
        //columnas

        $pdf->SetFillColor(180, 180, 180);
               $pdf->Cell(20, 5, '# ', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'USUARIO',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'PEDIDO',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'PRESUPUESTO',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'PROVEEDOR', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'ESTADO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'TOTAL', 0, 0, 'C', 1);

  $pdf->Ln();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('', '', 10);
    $pdf->Cell(20, 5, $orden['cod_ord_compra'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $orden['usu_nick'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $orden['cod_pedido_com']." - ". $orden['fecha_pedi'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $orden['cod_presu_com']." - ". $orden['fecha_presu_com'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $orden['provee_nomb']." - ". $orden['provee_tel'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $orden['orden_fecha'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $orden['orden_estado'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $orden['total_orden'], 0, 0, 'C', 1);
//           
        $pdf->Ln();
        $pdf->Ln();

        $detalles = consultas::get_datos("select * from v_ordencompdetalle "
                        . "where cod_ord_compra=" . $orden['cod_ord_compra'] . " order by cod_ord_compra");
        if (!empty($detalles)) {

            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
              
            $pdf->Cell(20, 5, '#', 1, 0, 'C', 1);
            $pdf->Cell(90, 5, 'ARTICULO', 1, 0, 'C', 1);
            $pdf->Cell(40, 5, 'CANTIDAD', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'PRECIO', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'SUBTOTAL', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 1, 0, 'C', 1);
       
            $pdf->Ln(); //salto

            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);



            foreach ($detalles as $detalle) {

       $pdf->Cell(20, 5, $detalle['cod_ord_compra'], 1, 0, 'C', 1);
                $pdf->Cell(90, 5, $detalle['arti_descrip'], 1, 0, 'C', 1);
                $pdf->Cell(40, 5, $detalle['orde_cant'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['orden_precio'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['detalle_ord_subt'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['orden_estado'], 1, 0, 'C', 1);
                $pdf->Ln();
            }
        } else {
            $pdf->SetFont('times', 'B', '14');
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(255, 0, 0);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
        }
    }
} else {
    $pdf->SetFont('times', 'B', '14');
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
}

//SALIDA AL NAVEGADOR
$pdf->Output('reporte_orden_compra.pdf', 'I');
?>
