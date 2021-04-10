<html>
<head>
<title>Форма заявки с сайта</title>
</head>
<body>
<?php
//проверяем, существуют ли переменные в массиве POST
if(!isset($_POST['fio']) and !isset($_POST['email'])){
 ?> <form action="send.php" method="post">
<input type="text" name="fio" placeholder="Укажите ФИО" required>
<input type="text" name="email" placeholder="Укажите e-mail" required>
<input type="submit" value="Отправить">
</form> <?php
} else {
 //показываем форму
 $fio = $_POST['fio'];
 $email = $_POST['email'];
 $fio = htmlspecialchars($fio);
 $email = htmlspecialchars($email);
 $fio = urldecode($fio);
 $email = urldecode($email);
 $fio = trim($fio);
 $email = trim($email);
 if (mail("example@mail.ru", "Заявка с сайта", "ФИО:".$fio.". E-mail: ".$email ,"From: example2@mail.ru \r\n")){
 echo "Сообщение успешно отправлено";
 } else {
 echo "При отправке сообщения возникли ошибки";
 }
}
?>
</body>
</html>
