<?php

	
if(!isset($_GET["pdf"]) && !isset($_GET["id"])  ) return false;
//if( isset($_GET["pdf"]) && isset($_GET["id"]) ) echo $_GET["id"];
require_once dirname(__FILE__).'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

$order_no = intval($_GET["id"]);
require_once('../include_db/db.php');
$stmt = $tf_handle->query("SELECT * FROM `invoice` WHERE `order_id` = '$order_no'");
if(!$stmt){
	header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
	die;
}
	

	ob_start();
	require_once('printA.php');
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    //$html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
	///////////////////////////////////////////
	// هذه اسم ملف المراد ان نحفظه exemple07.pdf
	// اذا تم اضافة براميتر ثاني سيقوم الحفظ بشكل تلقائي للملف
    //$html2pdf->output('exemple07.pdf','D');
	// اذا تم وضع براميتر واحد سيتم العرض في المتصفح للطباعة
    $html2pdf->output('exemple07.pdf');

	
?>

