<?php
require 'phpqrcode/qrlib.php';

$dir = 'temp/';

if( !file_exists( $dir ))
{
    mkdir( $dir);
}

$filename = "{$dir}test.png";

$tamanio = 7;
$level   = 'M';
$frameSize = 3;
$contenido = 'http://asistencia-socma.ddns.net/react-search';

QRcode::png($contenido,$filename,$level,$tamanio,$frameSize);

echo "<img src='{$filename}'  />";


?>