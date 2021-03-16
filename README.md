<div id="chat">
  <table>
    <tr>
      <td>Имя</td>
      <td>Сообщение</td>
      <td>Дата</td>
    </tr>
    <tr>
      <td>Имя</td>
      <td>Сообщение</td>
      <td>Дата</td>
    </tr>
  </table>
</div>
<p>
  <input type="text" name="message" id="message" />
  <input type="button" value="Отправить" onclick="send()" />
</p>
<script type="text/javascript">
  function send() {
    var message = document.getElementById("message").value;
    var name = "Гость";
    /* Здесь блок отправки POST-запроса с данными (например, через Ajax) */
  }
  function update() {
    /* Здесь отправка запроса на получение всех сообщений (например, через Ajax) */
    /* Здесь вывод сообщений в определённом формате прямо в HTML-код с использованием DOM, либо JQuery. */
  }
  setInterval("update()", 1000); // Обновление окна чата каждую секунду
</script>
<?php
  /* Получаем данные, полученные из JavaScript */
  $message = $_POST["message"];
  $name = $_POST["name"];
  $date = date(); // Узнаём текущее время и дату
  /* Здесь добавляем в таблицу новую запись */
?>
<?php
  /* Вытаскиваем все записи из таблицы */
  /* Получаем двумерный массив из полученных данных */
  /* Преобразуем массив в json-формат и возвращаем его в javascript, где он уже будет выводиться */
?>
