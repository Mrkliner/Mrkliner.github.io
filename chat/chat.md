<style>
  .chat {
	border:1px solid #333;
	margin:15px;
	width:40%;
	height:70%;
	background:#555;
	color:#fff;
}

.chat-messages {
	min-height:93%;
	max-height:93%;
	overflow:auto;
}

.chat-messages__content {
	padding:1px;
}

.chat__message {
	border-left:3px solid #333;
	margin-top:2px;
	padding:2px;
}

.chat__message_black {
	border-color:#000;
}

.chat__message_blue {
	border-color:blue;
}

.chat__message_green {
	border-color:green;
}

.chat__message_red {
	border-color:red;
}

.chat-input {
	min-height:6%;
}
input {
	font-family:arial;
	font-size:16px;
	vertical-align:middle;
	background:#333;
	color:#fff;
	border:0;
	display:inline-block;
	margin:1px;
	height:30px;
}

.chat-form__input {
	width:79%;
}

.chat-form__submit {
	width:18%;
}
</style>
<div class='chat'>
	<div class='chat-messages'>
		<div class='chat-messages__content' id='messages'>
			Загрузка...
		</div>
	</div>
	<div class='chat-input'>
		<form method='post' id='chat-form'>
			<input type='text' id='message-text' class='chat-form__input' placeholder='Введите сообщение'> <input type='submit' class='chat-form__submit' value='=>'>
		</form>
	</div>
</div>
