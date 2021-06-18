<?php

$fichero = filter_input(INPUT_GET, "fichero", FILTER_SANITIZE_STRING);
$path = '/var/www/pdfs/'.$fichero;

$amb_file = basename($path);

$attachment_location = $path;
if (file_exists($attachment_location)) 
{
	$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
	$mime = finfo_file($finfo, $attachment_location);

	header("Content-Type: {$mime}");
	header('Content-Length: '.filesize($attachment_location));
	header('Content-Disposition: attachment; filename='.$amb_file);
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	ob_end_clean();
	readfile($attachment_location);
	exit(); 
} 
header("HTTP/1.0 404 Not Found");
return;
