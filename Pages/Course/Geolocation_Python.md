<h1>Как узнать гео-локацию стройства на python по ip (полный курс)</h1>
<h3>Для этого нам понадобится:</h3>
<h3><ul><li>Python</li><li>Библиотека для python geocoder</li><li>Желание</li><li>Базовые навыки Python</li></ul></h3>
<h3>Да, да это всё что нам нужно, давайте установим библиотеку geocoder - сделать это можно вот так:</h3>
<h3><code>pip install geocoder</code></h3>
<h2>Пишем программу</h2>
<h3>Давайте импортируем эту библиотеку в проект таким образом: </h3>
<h3><code>import geocoder as g</code></h3>
<h3>После того как мы импортировали библиотеку в проект мы должны проверить её. Сделать это вот так:</h3>
<h3><code>geo = g.ip('me')</code></h3>
<h3><code>print (ge.latlng)</code></h3>
<h3>После проделанных действий запускаем прогу и видим цифры, а эти цифры являются координатами по которым расположен данный ip адрес давайте с вами выведим город область и страну </h3>
<h3><code>print (g.ip('me'))</code></h3>
<h3>При следующем запуске программы у нас будет написанно примерно вот это [IP Inf - OK[Penza, Penza, RU]] это нам показало Город, область и обозначение страны</h3>
<h2>Делаем программу доступнее</h2>
<hr>
<h3>Я вам предлогаю сделать эту программу доступнее для пользователя</h3>
<h3>Давайте зададим цвет тексту нашей программы. И сделаем это таким образом:</h3>
<h3><code>import os as s</code></h3>
<h3>И заставим нашу консоль выполнить комманду color B (цвет текста)</h3>
<h3><code>s.system ('color B')</code></h3>
<h3>Далее мы сделаем ввод ip от пользователя таким образом:</h3>
<h3><code>ipi = input()</code></h3>
<h3><code>print ('Город, область, страна')</code></h3>
<h3><code>print (g.ip(ipi))</code></h3>
<h3>Широта и долгота (координаты)</h3>
<h3><code>print (geo.latlng)</code></h3>
<h3><code>s.system ('pause')</code></h3>
<h3><code>s.system ('cls')</code></h3>
<h3>Вот мы и написали нашу программу! Мы получили достаточно много опыта и новые интересы!</h3>
<h2>Исходники</h2>
<h3><code>import geocoder as g</code></h3>
<h3><code>import os as s</code></h3>
<h3><code>while True:</code></h3>
<h3><code>      s.system ('color B')</code></h3>
<h3><code>      print ('Введите айпи или введите (Мой айпи) для просмотра вашей гео-локации')</code></h3>
<h3><code>      ipi = input('>>')</code></h3>
<h3><code>      if ipi == 'Мой айпи':</code></h3>
<h3><code>             print ('Город, страна:')</code></h3>
<h3><code>             print (g.ip('me'))</code></h3>
<h3><code>             geo = g.ip('me')</code></h3>
<h3><code>      else:</code></h3>
<h3><code>             geo = g.ip(ipi)</code></h3>
<h3><code>             print ('Город, страна:')</code></h3>
<h3><code>             print (g.ip(ipi))</code></h3>
<h3><code>      print ('\nШирота и долгота')</code></h3>
<h3><code>      print ('geo.latlng')</code></h3>
<h3><code>      s.system ('pause')</code></h3>
<h3><code>      s.system ('cls')</code></h3>          
