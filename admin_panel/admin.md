<h1>Панель администратора</h1>
<hr>
<script type="text/javascript">
  function Main() {
    var b;
    var user1;
    if (user1 != "") {
      if (b == 1) {
        alert ("Пользователь найден!");
      }
      else {
        alert ("Пользователь не найден!");
      }
    }
    else {
      alert ("Вы не ввели пользователя");
    }
  }
</script>
<input type="button" value="проверить пользователя по базе" oneclick="Main()">
