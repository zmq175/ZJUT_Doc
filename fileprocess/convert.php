<?php
function file_convert($path,$filename,$typesIf)
{
	$officepath="/var/www/html/upload/office/";
	$pdfpath="/var/www/html/upload/pdf/";
	$swfpath="/var/www/html/upload/swf/";
	if (file_exists($path.$filename)) {
		if ($typesIf=='pdf') {
			$pdf = $filename;
			$swf = str_replace('pdf','swf',$pdf);
			exec("/usr/local/bin/pdf2swf -s languagedir=/usr/share/xpdf/xpdf-chinese-simplified -T 9 -s poly2bitmap -s zoom=150 -s flashversion=9 ".$pdfpath.$pdf." -o ".$swfpath.$swf."",$output);
			$path2 = $pdfpath.$pdf;
			$path3 = $swfpath.$swf;
		}
		elseif ($typesIf=='doc'||$typesIf=='docx'||$typesIf=='xls'||$typesIf=='xlsx'||$typesIf=='ppt'||$typesIf=='pptx') {
			$office=$filename;
			$format=explode(".", $filename);
			$formatName = $format[0].'.pdf';
			echo "java -jar /var/www/html/convert/jodconverter-cli-2.2.2.jar '.$officepath.$office' '.$pdfpath.$formatName'";
			exec("java -jar /var/www/html/convert/jodconverter-cli-2.2.2.jar {$officepath}{$office} {$pdfpath}{$formatName}",$output);
			$path1=$officepath.$office;
			$path2=$pdfpath.$formatName;
			if (file_exists($pdfpath.$formatName))
			{
				$pdf = $formatName;
				$swf = str_replace('pdf','swf',$pdf);
				exec("//usr/local/bin/pdf2swf -s languagedir=/usr/share/xpdf/xpdf-chinese-simplified -T 9 -s poly2bitmap -s zoom=150 -s flashversion=9 ".$pdfpath.$pdf." -o ".$swfpath.$swf."");
				$path3 = $swfpath.$swf;
			}
		}
	}

}
?>