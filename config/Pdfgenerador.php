<?php
require_once "clases/dompdf/autoload.inc.php";
use Dompdf\Dompdf;
use Dompdf\Options; 

class Pdfgenerador {

  public static function generate($html, $filename, $stream, $paper, $orientation)
{
    $options = new Options();
    $options->set(array(
            'isPhpEnabled' => true,
            'isRemoteEnabled' => true,
            'isJavascriptEnabled'=> true)
    );
    
//    $fyhora = date('d/m/Y H:i:s');   
    $dompdf = new DOMPDF($options);
    $dompdf->getOptions();
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();

    $fontMetrics = $dompdf->getFontMetrics();
    $font = $fontMetrics->get_font("times-roman", "bold");
    $canvas = $dompdf->get_canvas();
    if($orientation == "portrait"){
        $canvas->page_text(530, 750, "Pag. {PAGE_NUM} de {PAGE_COUNT}", $font, 9, array(0, 0, 0));
    }else{
        $canvas->page_text(750, 550, "Pag. {PAGE_NUM} de {PAGE_COUNT}", $font, 9, array(0, 0, 0));
    }
    
    
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }
  }
}