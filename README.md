2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
	
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Chat</title>
</head>
<body>
 
    <main>
        <div id="divMessages" class="message border rounded container">
 
        </div>
        <div class="container">
            <div id="blockSendMessage" class="row">
                <input id="inputMessage" class="form-control col-8 col-sm-9 col-md-8" type="text" placeholder="Сообщений">
                <button id="btnSend" type="button" class="btn btn-secondary col-4 col-sm-3 col-md-4">Отправить</button>
            </div>
        </div>
        
    </main>
</body>
</html>
