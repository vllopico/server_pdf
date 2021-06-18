<?php

$pdo = new PDO('mysql:host=127.0.0.1;dbname=bbdd_pdf;charset=utf8','root', '****');

$sql_files = "SELECT id, referencia, fichero FROM .file_pdf ";
$smt_files = $pdo->prepare($sql_files);
$smt_files->execute();
echo json_encode(array("data"=>$smt_files->fetchAll(PDO::FETCH_ASSOC)));
return;
