<?php
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
 if (mail("agarrismodov@gmail.ru", "Заявка с сайта", "oтзыв:".$fio.". E-mail: ".$email ,"From: example2@mail.ru \r\n")){
 echo "Сообщение успешно отправлено";
 } else {
 echo "При отправке сообщения возникли ошибки";
 }
}
?>
