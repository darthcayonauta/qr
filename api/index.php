<?php

require_once("../class/pdo.class.php");
header('Access-Control-Allow-Origin: *');

$ob_pdo = new PdoConnect();
//aun nada de api rest o fetch

$query="SELECT * FROM test";
$result= $ob_pdo->getMethod( $query );

echo json_encode( $result->fetchAll() );
header("HTTP/1.1 200 OK");
exit();

?>