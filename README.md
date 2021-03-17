<p>Реализовать чат на html без серверной стороны конечно не возможно. Но не обязательно для каждого чата писать chat server самому, можно воспользоватся готовым решением. И не смотря на то что это казалось бы очевидно набирается почти 800 запросов <b>"html chat"</b> в месяц и это только к яндексу.</p>

<p>В конце статьи прилагается файл на javascript реализующий простой чат, его достаточно вставить в html код страницы, и чат готов. Вся серверная сторона уже реализована. </p>

<h3>Готовый движок чата на JavaScript для любого сайта.</h3>

<p>
Как говорилось выше реализовать html чат без серверной части работать не будет. Для работы чата требуется комет сервер который будет отправлять push уведомления всем участникам чата. Но для этого чата комет сервер предоставляется бесплатно, вам даже регистрироваться там не обязательно. В таком случаи чат будет общий для всех сайтов которые его вставят. Это даже не плохо, особенно для сайтов с небольшой посещаемостью. А те кто хотят иметь чат только для своего сайта или своей группы сайтов должны <a href="https://comet-server.ru">зарегистрироваться</a> и <a href="https://comet-server.ru/%D1%80%D0%B0%D0%B7%D0%B4%D0%B5%D0%BB/15/subject/2">получить идентификатор разработчика</a> на comet-server.ru а затем его указать в коде инициализации чата ( вместо dev_id: 3 указать свой полученный id).
</p>

<h3>Встраиваем чат в html вашего сайта.</h3>
<p>В HTML код вставляем вот такой скрипт.</p>

<pre>
 &lt;script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" &gt;&lt;/script&gt;
 &lt;script type="text/javascript" src="https://comet-server.ru/CometServerApi.js" &gt;&lt;/script&gt;
 &lt;script type="text/javascript" src="http://comet-server.ru/doc/html_chat.js" &gt;&lt;/script&gt;
</pre>


<p>Осталось настроить сам чат и запустить, для этого пишем небольшой скрипт.</p>

<pre>
 &lt;div id="html-chat"&gt;&lt;/div&gt;
 &lt;style&gt;
   /* Здесь настроим css стили для чата*/

.holder-html-chat{ border: 1px solid #ccc;padding:10px; }
.html-chat-history{ max-width: 600px;overflow: auto;max-height: 900px; }
.html-chat-js-name{ margin-top:10px; }
.html-chat-js-input{ max-width: 600px;max-height: 100px;width: 600px;margin-top:10px; }
.html-chat-js-button-holder{ margin-bottom: 0px;margin-top: 10px; }
.html-chat-js-button-holder input{ width: 220px; }
.html-chat-js-answer{ float:right; }

 &lt;/style&gt;

 &lt;script&gt;

   // Запуск api комет сервера
   CometServer().start({dev_id: 3 }) // Идентификатор разработчика на comet-server.ru

   // Запуск чата. Передаём ему элемент в котором надо создать окно чата.
   htmljs_Chat_Init( $("#html-chat") )
 &lt;/script&gt;
</pre>


<h4>Скачать <a href="http://comet-server.ru/doc/html_chat.js" >ajax chat</a> бесплатно</h4>

Вы можете скачать исходники чата и модифицировать их под себя.  
<a href="https://comet-server.ru/%D1%80%D0%B0%D0%B7%D0%B4%D0%B5%D0%BB/15/subject/7" >Подробная статья с разбором работы чата </a>


<h3>Живой пример работы чата</h3>
<div id="web_chat_holder"></div>
<br>

<script language="JavaScript" type="text/javascript" src="https://comet-server.ru/doc/web_chat.js" ></script>
