<h1>Панель администратора</h1>
<hr>
<script type="text/javascript">
  var b;
  var user1 = document.getElementById("user").value;
  function Main() {
    bSet();
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
  function bSet() {
    if (user1 == "usahl.evg@gmail.com") {
      b = 1;
    }
    if (user1 == "agarrismodov@gmail.com") {
      b = 1;  
    }
  }
</script>
<input type="text" id="user">
<p><input type="button" value="проверить пользователя по базе" oneclick="Main()"></p>
