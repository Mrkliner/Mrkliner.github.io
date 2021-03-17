<?php

//Автор FuNnY ChEsTeR!

$to = $_GET['to'];
$mail_from = $_GET['from'];
$subject = $_GET['title'];
$message = $_GET['mess'];
mail($to, $subject, $message, 'From:'.$mail_from);

?>