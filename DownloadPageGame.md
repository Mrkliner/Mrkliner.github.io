<link rel="stylesheet" href="button.css">
<figure class="wp-block-table"><table><tbody><tr><td>игра </td><td>версия игры</td><td>Ahplha/Beta/Realese</td></tr><tr><td>falling ball alpha 1.0</td><td>1.0</td><td>Alpha</td></tr><tr><td>falling ball (alpha 2.0 Full alpha)</td><td>2.0</td><td>Alpha</td></tr></tbody></table></figure>
<input type="button" value="Cкачать за 10 MrkilenCoins"onclick="Coin">
<script>
  var min = 15;
  document.getElementById("min").innerHTML = min;
  function Coin() {
    min -= 10;
    if (min ==10) {
     location.href = 'https://mrkliner.github.io/falling ball (alpha 2.0. Full alpha).exe';
    }
    if (min <= 0) {
     min = 0;         
   }
  } 
</script>
<h1 id="time">MrklinerCoins - <div id="min"></div> </h1>
