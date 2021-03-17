<?php

date_default_timezone_set('Europe/Moscow'); //Устанавливает часовой пояс

$Login = $_GET['login'];
$Msg = $_GET['mess'];

$Message = "[" . date("H:i:s") . "] [" . $Login . "] - " . $Msg;

file_put_contents("Chats.txt", "$Message\n", FILE_APPEND);

?>