<?php 
date_default_timezone_set("America/Guayaquil");
$exportando="SI";
ob_start();
include('consulta.php');
$content =ob_get_clean();
include("clases/mpdf.php");
$mpdf=new mPDF('c','A4-L'); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
//$mpdf->defaultheaderfontsize = 10;	/* in pts */
//$mpdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
//$mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */
//$mpdf->defaultfooterfontsize = 10;	/* in pts */
//$mpdf->defaultfooterfontstyle = B;	/* blank, B, I, or BI */
//$mpdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */
//$mpdf->SetHeader('Generado al: '.$fecha.' '.$hora_f.'||INFORME DEL SISMANWEB');
//$mpdf->SetFooter('||{PAGENO} de {nb}','O');	/* defines footer for Odd and Even Pages - placed at Outer margin */
$mpdf->SetHeader('||Informes Consolidados');
$mpdf->SetFooter('|{PAGENO}/{nb}|Impreso @ {DATE j-m-Y H:m}');	/* defines footer for Odd and Even Pages - placed at Outer margin */

//$mpdf->SetFooter(array(
//	'L' => array(
//		'content' => 'Reporte saldos por Zonas',
//		'font-family' => 'sans-serif',
//		'font-style' => 'BI',	/* blank, B, I, or BI */
//		'font-size' => '10',	/* in pts */
//	),
//	'C' => array(
//		'content' => '{PAGENO}/{nb}',
//		'font-family' => 'sans-serif',
//		'font-style' => 'BI',
//		'font-size' => '10',	/* gives default */
//	),
//	'R' => array(
//		'content' => 'Impreso @ {DATE j-m-Y H:m}',
//		'font-family' => 'sans-serif',
//		'font-style' => 'BI',
//		'font-size' => '10',
//	),
//	'line' => 1,		/* 1 to include line below header/above footer */
//), 'E'	/* defines footer for Even Pages */
//);
$mpdf->WriteHTML($content);
$nombre="RPTpermiso".$_SESSION["gd_usuario"].".pdf";
$ubicacion="documentos/temp/".$nombre;
$destino_temp= $_SERVER['DOCUMENT_ROOT']."/".$directorio2."/".$ubicacion;
$mpdf->Output($destino_temp,"F");

echo "<script>window.open('".$ubicacion."', '_blank');</script>";
?>
