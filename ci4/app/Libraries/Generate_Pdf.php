<?php 
namespace App\Libraries;
class Generate_Pdf {

	
	function load_portait($param=NULL)
	{	
		//require 'vendor/autoload.php';
	    if ($param == NULL)
	    {
			$param = [
				'mode' => 'utf-8',
				'format' => 'A4-L',
				'margin_left' => '20', 
				'margin_right' => '20', 
				'margin_top' => '15', 
				'margin_bottom' => '15', 
				'margin_header' => '6', 
				'margin_footer' => '3', 
				'tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf'
			];
	    }
	    //new mPDF($mode, $format, $font_size, $font, $margin_left, $margin_right, $margin_top, $margin_bottom, $margin_header, $margin_footer, $orientation);
		return new \Mpdf\Mpdf($param);
	}
}