<?php
/*
.......................................................
.                     Мини-Чат                        .
.                версия от 02.07.2020                 .
.						UTF-8                         .
.                                                     .
.                  (C) By Protocoder                  .
.                     protocoder.ru                   .
.                                                     .
. распространяется по лицензии Creative Commons BY-NC .
.   http://creativecommons.org/licenses/by-nc/3.0/    .
.......................................................
*/

//sleep( 3 ); //Я точно забуду удалить эту отладачную строку...

mb_internal_encoding( "UTF-8" );
mb_http_output( "UTF-8" );
mb_http_input( "UTF-8" );
mb_language( "uni" );
mb_regex_encoding( "UTF-8" );
ob_start( "mb_output_handler" );

setlocale( LC_ALL, array( 'ru_RU.UTF-8', 'ru_RU.UTF8', 'ru_RU.65001' ), array( 'rus_RUS.UTF-8', 'rus_RUS.UTF8', 'rus_RUS.65001' ), array( 'Russian_Russia.UTF-8', 'Russian_Russia.UTF8', 'Russian_Russia.65001' ) );
setlocale( LC_NUMERIC, 'C' ); //in float number deilmiter = "."


//Боремся с включенными magic quotes
if ( function_exists( "get_magic_quotes_gpc" ) && get_magic_quotes_gpc() === 1 ) {
	$_COOKIE = array_map( "stripslashes", $_COOKIE );
	$_POST = array_map( "stripslashes", $_POST );
}

define( "DBFILE", realpath( str_replace( '\\', '/', __DIR__ ) ) . "/chat.db" ); //Путь и имя файла с чатом
define( "REFRESHTIME", 5 * 1000 ); //Клиентская задержка опроса сервера
define( "HEADER", "ProtoChat" ); //Заголовок

define( "COOKIEPATH", "/" );

define( "CHATTRIM", 0 ); //Максимальная длина пересылаемого куска чата, 0 - без ограничений

define( "MAXUSERNAMELEN", 64 ); //Максимальная длина имени пользователя
define( "MAXUSERTEXTLEN", 1024 ); //Максимальная длина сообщения пользователя

function makeURL( $matches ) {
	return '<a href="' . ( mb_strpos( $matches[1], "://" ) === false ? "http://" : "" ) . $matches[1] . '" target="_blank">' . $matches[1] . '</a>';
}

function chatOut( $status = null, $chat = null ) {
	if ( $status !== null ) {
		$lastMod = filemtime( DBFILE );
		if ( $lastMod === false ) $lastMod = 0;
		echo( "{$status}:$lastMod\n" );
	}

	if ( $chat === null ) {
		if ( CHATTRIM ) {
			$f = fopen( DBFILE, "r" );
			fseek( $f, -CHATTRIM, SEEK_END );
			$chat = fread( $f, CHATTRIM );
			fclose( $f );
			$p =  mb_strpos( $chat, '<div class="msg"' );
			if ( $p !== false ) {
				$chat = mb_substr( $chat, $p );
			}
		}
		else $chat = file_get_contents( DBFILE );
	}

	echo( $chat );
}

function cleanName( $str ) {
	$str = trim( $str );
	$str = preg_replace( "~[^ 0-9a-zа-яё]~iu", "", $str );
	$str = mb_substr( $str, 0, MAXUSERNAMELEN );
	return $str;
}

function cleanText( $str ) {
	$str = trim( $str );
	$str = preg_replace( "~\r~u", "", $str );
	$str = preg_replace( "\x07[^ \t\n!\"#$%&'()*+,\\-./:;<=>?@\\[\\]^_`{|}~0-9a-zа-яё]\x07iu", "", $str );
	$str = preg_replace( "~&~u", "&amp;", $str );
	$str = preg_replace( "~<~u", "&lt;", $str );
	$str = preg_replace( "~>~u", "&gt;", $str );
	$str = mb_substr( $str, 0, MAXUSERTEXTLEN );
	$str = preg_replace( "~\n~u", "<br />", $str );

	return $str;
}






$exit = false;

$name = @$_POST["name"] ? $_POST["name"] : null;

$text = @$_POST["text"];

$mode = null;
switch( @$_POST["mode"] ) {
	case "post":
		$mode = "post";
	break;

	case "list":
		$mode = "list";
	break;
}

$cookieName = @$_COOKIE["userName"] ? $_COOKIE["userName"] : null;
if ( $cookieName ) $cookieName = cleanName( $cookieName );

if ( !$name ) $name = $cookieName;
if ( $text ) $text = cleanText( $text );

if ( $mode == "post" ) {
	if ( !$name || !$text ) {
		header( 'HTTP/1.1 400 Bad Request' );
		exit( 0 );
	}

	if ( !@empty( $_SERVER[ "HTTP_CLIENT_IP" ] ) ) $id = $_SERVER[ "HTTP_CLIENT_IP" ];
	elseif ( !@empty( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) $id = $_SERVER["HTTP_X_FORWARDED_FOR"];
	else $id = @$_SERVER["REMOTE_ADDR"];

	$exit = true;

	if ( $name != $cookieName ) setcookie( "userName", $name, mktime( 0, 0, 0, 12, 31, 3000 ), COOKIEPATH );

	$text = preg_replace_callback( "\x07((?:[a-z]+://(?:www\\.)?)[_.+!*'(),/:@~=?&$%a-z0-9\\-]+)\x07iu", "makeURL", $text );
	$msg = '<div class="msg"><div class="info"><span class="name">' . $name . '</span><span class="misc"><span class="date">' . date( "d.m.Y H:i:s" ) . '</span> <span class="id">(' . $id . ')</span></span></div>' . $text . '</div>' . "\n\n";

	file_put_contents( DBFILE, $msg, FILE_APPEND );

	$mode = "list";
}

if ( $mode == "list" ) {
	$exit = true;

	$rlm = preg_match( "~^\\d+$~u", @$_POST["lastMod"] ) ? (int)$_POST["lastMod"] : 0;

	$lastMod = filemtime( DBFILE );
	if ( $lastMod === false ) $lastMod = 0;

	if ( $rlm == $lastMod ) chatOut( "NONMODIFIED", "" );
	else chatOut( "OK", null );
}

if ( $exit ) exit( 0 );

$lastMod = filemtime( DBFILE );
if ( $lastMod === false ) $lastMod = 0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
	<head>
		<title>ProtoChat</title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="robots" content="noindex, nofollow">
		<meta content="width=1024" name="viewport" />

		<style type="text/css">
			div, span, applet, object, iframe,
			h1, h2, h3, h4, h5, h6, p, blockquote, pre,
			a, abbr, acronym, address, big, cite, code,
			del, dfn, em, font, img, ins, kbd, q, s, samp,
			small, strike, strong, sub, sup, tt, var,
			dl, dt, dd, ol, ul, li,
			fieldset, form, label, legend,
			table, caption, tbody, tfoot, thead, tr, th, td {
				margin: 0;
				padding: 0;
				outline: 0;
				font-weight: inherit;
				font-style: inherit;
				font-size: 100%;
				font-family: inherit;
				line-height: 1.3em;
			}

			html, body {
				margin: 0;
				padding: 0;
				outline: 0;
				font-size: 100%;
				font-family: inherit;
				background-color: #FFFFFF;
				font-family: Tahoma;
				color: #000000;
				line-height: 1em;
				height: 100%;
			}

			input, textarea {
				outline-style: none;
			}

			a img {
				border-width: 0;
			}

			div,
			input,
			textarea {
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				-ms-box-sizing: border-box;
				box-sizing: border-box;
			}

			form {
				display: inline;
			}

			h1 {
				font-family: Verdana;
				margin: 0 0 0.5em 0;				
				font-size: 3em;
				font-weight: bold;
				text-align: center;
				color:#FFFFFF;
				text-shadow:
					0 1px 0 #ccc,
					0 2px 0 #c9c9c9,
					0 3px 0 #bbb,
					0 4px 0 #b9b9b9,
					0 5px 0 #aaa,
					0 6px 1px rgba(0,0,0,.1),
					0 0 5px rgba(0,0,0,.1),
					0 1px 3px rgba(0,0,0,.3),
					0 3px 5px rgba(0,0,0,.2),
					0 5px 10px rgba(0,0,0,.25),
					0 10px 10px rgba(0,0,0,.2),
					0 20px 20px rgba(0,0,0,.15);
			}

			a {
				color: #1483FF;
				text-decoration: none;
			}

			a:hover {
				text-decoration: underline;
			}

			#wrapper {
				width: 30em;
				text-align: left;
				margin: auto;
				position: relative;
				z-index: 1;
				padding: 1em;
			}

			#msgsContent {
				width: 100%;
				height: 20em;
				overflow: auto;
			}

			#msgsContent .msg {
				margin-bottom: 0.5em;
				padding-top: 0.5em;
				position: relative;
				z-index: 1;
				cursor: pointer;
				word-wrap: break-word;
			}

			#msgsContent .msg + .msg {
				border: dashed #E0E0E0;
				border-width: 1px 0 0 0;
			}

			#msgsContent .msg:hover:after {
				content: "";
				position: absolute;
				top: 0.5em;
				left: 0;
				bottom: 0;
				right: 0;
				z-index: -1;
				background: #F0F0F0;
			}

			#msgsContent .msg .info {
				margin-bottom: 0.2em;
				color: #0056c6;
			}

			#msgsContent .msg .info .name {
				font-weight: bold;
				padding-right: 0.5em;
				color: #1483FF;
			}

			#msgsContent .msg .info .misc {
				font-size: 0.8em;
			}

			#msgsContent .msg .info .date {
				padding-right: 0.5em;
				display: inline-block;
				white-space: nowrap;
			}

			#msgsContent .msg .info .id {
				font-size: 0.8em;
			}

			#msgsContent .msg a {
				color: #000EFF;
			}

			#msgsDialog .options {
				display: inline-block;
				margin-top: 1em;
				margin-right: 1em;
				font-family: Tahoma;
				font-size: 0.8em;
				font-weight: bold;
				cursor: pointer;
				color: #707070;
			}

			#msgsDialog .options input {
				vertical-align: top;
				cursor: pointer;
				width: 1em;
				height: 1em;
			}


			#sendDialog textarea,
			#sendDialog input[type=text],
			#sendDialog input[type=password] {
				display: block;
				width: 100%;
				box-sizing: border-box;
				font-family: inherit;
				border: 1px solid rgba(0, 0, 0, 0.3 );
				border-radius: 0.18em;
				-webkit-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.36) inset;
				box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.36) inset;
				padding: 0.2em;
				font-family: inherit;
				font-size: 1em;
			}

			#sendDialog input[type=text],
			#sendDialog input[type=password] {
				min-height: 1.6em;
				padding: 0 0.2em;
			}

			#sendDialog input[type=submit] {
				width: 10em;
			}

			#sendDialog input[name=name] {
				font-weight: bold;
			}
	
			#sendDialog textarea[name=text] {
				min-height: 10em;
				resize: none;
			}

			#submit {
				margin-top: 0.5em;
			}

			.waiter {
				position: absolute;
				top: 0;
				left: 0;
				bottom: 0;
				right: 0;
				z-index: 10000;
				opacity: 0.3;
			}

			.waiterProgress {
				background: url("data:image/gif;base64,R0lGODlhDAAMAPABAAICAgAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQJCgABACwAAAAADAAMAAACFUR+hrmh+1iLrlVoKdB5duyBojQ6BQAh+QQJCgABACwAAAAADAAMAAACFYwNh6ncGtyREdYHKb1TW5+F4vSFBQAh+QQJCgABACwAAAAADAAMAAACF4wDZ6nYwE6Urzk1V92Ur5xdHeZpZFAAACH5BAkKAAEALAAAAAAMAAwAAAIWjGGJeRzL4JHP1WgpvSq7rWke9pVGAQAh+QQJCgABACwAAAAADAAMAAACF0xgiWmr3KB7DMwDcc33arqFYtNxElMAACH5BAUKAAEALAAAAAAMAAwAAAIWDIJ4qWz+2JJuJmswjhdqX4FUKH1MAQA7" );
			}

			.block {
				position: relative;
				padding: 1em;
				-webkit-box-shadow: 0 0 3px rgba( 0, 0, 0, 0.5 );
				box-shadow: 0 0 3px rgba( 0, 0, 0, 0.5 );
			
				background: #FFFFFF;
				background: -moz-linear-gradient(top,  #F2F2F2 0%, #FFFFFF 20%, #FFFFFF 80%, #F2F2F2 100%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#F2F2F2), color-stop(20%,#FFFFFF), color-stop(80%,#FFFFFF), color-stop(100%,#F2F2F2));
				background: -webkit-linear-gradient(top,  #F2F2F2 0%,#FFFFFF 20%,#FFFFFF 80%,#F2F2F2 100%);
				background: -ms-linear-gradient(top,  #F2F2F2 0%,#FFFFFF 20%,#FFFFFF 80%,#F2F2F2 100%);
				background: linear-gradient(to bottom,  #F2F2F2 0%,#FFFFFF 20%,#FFFFFF 80%,#F2F2F2 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#F2F2F2', endColorstr='#F2F2F2',GradientType=0 );
			}
			
			.block .ct,
			.block .cb {
				position: absolute;
				z-index: -1;
				height: 100%;
				left: -16px;
				right: -16px;
				overflow: hidden;
			}
			
			.block .ct {
				top: -5px;
			}
			
			.block .cb {
				bottom: -5px;
			}
			
			.block .ct:before,
			.block .ct:after,
			.block .cb:before,
			.block .cb:after {
				content: "";
				position: absolute;
				display: inline-block;
				height: 100px;
				width: 100px;
			}
			
			.block .ct:before {
				top: 5px;
				left: 3px;
			
				-webkit-box-shadow: -10px -10px 10px rgba(0, 0, 0, 0.4);
				box-shadow: -10px -10px 10px rgba(0, 0, 0, 0.4);
			
				-webkit-transform: rotate(0deg) translate(40px, 15px) skew(20deg);
				-moz-transform: rotate(0deg) translate(40px, 15px) skew(20deg);
				-ms-transform: rotate(0deg) translate(40px, 15px) skew(20deg);
				transform: rotate(0deg) translate(40px, 15px) skew(20deg);
			}
			
			.block .ct:after {
				top: 5px;
				right: 3px;
			
				-webkit-box-shadow: 10px -10px 8px rgba(0, 0, 0, 0.4);
				box-shadow: 10px -10px 8px rgba(0, 0, 0, 0.4);
			
				-webkit-transform: rotate(0deg) translate(-40px, 15px) skew(-20deg);
				-moz-transform: rotate(0deg) translate(-40px, 15px) skew(-20deg);
				-ms-transform: rotate(0deg) translate(-40px, 15px) skew(-20deg);
				transform: rotate(0deg) translate(-40px, 15px) skew(-20deg);
			}
			
			.block .cb:before {
				bottom: 5px;
				left: 3px;
			
				-webkit-box-shadow: -10px 10px 10px rgba(0, 0, 0, 0.4);
				box-shadow: -10px 10px 10px rgba(0, 0, 0, 0.4);
			
				-webkit-transform: rotate(0deg) translate(40px, -15px) skew(-20deg);
				-moz-transform: rotate(0deg) translate(40px, -15px) skew(-20deg);
				-ms-transform: rotate(0deg) translate(40px, -15px) skew(-20deg);
				transform: rotate(0deg) translate(40px, -15px) skew(-20deg);
			}
			
			.block .cb:after {
				bottom: 5px;
				right: 3px;
			
				-webkit-box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.4);
				box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.4);
			
				-webkit-transform: rotate(0deg) translate(-40px, -15px) skew(20deg);
				-moz-transform: rotate(0deg) translate(-40px, -15px) skew(20deg);
				-ms-transform: rotate(0deg) translate(-40px, -15px) skew(20deg);
				transform: rotate(0deg) translate(-40px, -15px) skew(20deg);
			}
			
			.block2 {
				padding: 1em;
				position: relative;
				display: block;
/*
				background: -webkit-gradient(linear,left top,left bottom,from(rgb(255, 255, 255)),color-stop(rgb(243, 243, 243),0.1),color-stop(rgb(255, 255, 255),0));
				background: -webkit-linear-gradient(0% 0% , rgb(255, 255, 255), rgb(243, 243, 243) 10%, rgb(255, 255, 255)) repeat scroll 0% 0% transparent;
				background:   -moz-linear-gradient(0% 0% , rgb(255, 255, 255), rgb(243, 243, 243) 10%, rgb(255, 255, 255)) repeat scroll 0% 0% transparent;
				background:        linear-gradient(0% 0% , rgb(255, 255, 255), rgb(243, 243, 243) 10%, rgb(255, 255, 255)) repeat scroll 0% 0% transparent;
*/

				background: -moz-linear-gradient(top,  #F2F2F2 0%, #FFFFFF 20%, #FFFFFF 80%, #F2F2F2 100%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#F2F2F2), color-stop(20%,#FFFFFF), color-stop(80%,#FFFFFF), color-stop(100%,#F2F2F2));
				background: -webkit-linear-gradient(top,  #F2F2F2 0%,#FFFFFF 20%,#FFFFFF 80%,#F2F2F2 100%);
				background: -ms-linear-gradient(top,  #F2F2F2 0%,#FFFFFF 20%,#FFFFFF 80%,#F2F2F2 100%);
				background: linear-gradient(to bottom,  #F2F2F2 0%,#FFFFFF 20%,#FFFFFF 80%,#F2F2F2 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#F2F2F2', endColorstr='#F2F2F2',GradientType=0 );

				border: 1px solid rgb(204, 204, 204);

				-webkit-box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1) inset;
				box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1) inset;
				border-radius: 6px 6px 6px 6px / 60px 60px 60px 60px;
			}

			.block2 .ad {
				position: absolute;
				top: 0;
				left: 0;
				bottom: 0;
				right: 0;
				z-index: -1;
			}

			.block2:before,
			.block2:after,
			.block2 .ad:before,
			.block2 .ad:after {
				content: "";
				width: 50px;
				height: 50px;
				position: absolute;
				-webkit-box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
				box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
				z-index: -1;
			}

			.block2:after {
				top: 23px;
				left: 20px;
				-webkit-transform:skew(0deg, 32deg) rotate(-205deg);
				-moz-transform:skew(0deg, 32deg) rotate(-205deg);
				-ms-transform:skew(0deg, 32deg) rotate(-205deg);
				transform:skew(0deg, 32deg) rotate(-205deg);
			}

			.block2 .ad:after {
				top: 23px;
				right: 20px;
				-webkit-transform:skew(0deg, -32deg) rotate(-60deg);
				-moz-transform:skew(0deg, -32deg) rotate(-60deg);
				-ms-transform:skew(0deg, -32deg) rotate(-60deg);
				transform:skew(0deg, -32deg) rotate(-60deg);
			}

			.block2 .ad:before {
				bottom: 23px;
				left: 20px;
				-webkit-transform:skew(0deg, -32deg) rotate(115deg);
				-moz-transform:skew(0deg, -32deg) rotate(115deg);
				-ms-transform:skew(0deg, -32deg) rotate(115deg);
				transform:skew(0deg, -32deg) rotate(115deg);
			}

			.block2:before {
				bottom: 23px;
				right: 20px;
				-webkit-transform:skew(0deg, 32deg) rotate(-25deg);
				-moz-transform:skew(0deg, 32deg) rotate(-25deg);
				-ms-transform:skew(0deg, 32deg) rotate(-25deg);
				transform:skew(0deg, 32deg) rotate(-25deg);
			}


			
			.button {
				display: inline-block;
				position: relative;
			
				padding: 0.2em 0.4em;
				vertical-align: top;
			
				cursor: pointer;
				text-decoration: none;
			
				font-family: Tahoma;
				font-weight: bold;
				color: #555555;
			
				border-radius: 0.18em;
			
				border: 1px solid #C2C2C2;
			
				border-radius: 0.18em;
			
				-webkit-box-shadow: inset 0 0 1px #FFFFFF;
				box-shadow: inset 0 0 1px #FFFFFF;
			
				background: #E5E5E5 -webkit-linear-gradient( 180deg, #FFFFFF, #DFDFDF );
				background: #E5E5E5 -moz-linear-gradient( 180deg, #FFFFFF, #DFDFDF );
				background: #E5E5E5 -ms-linear-gradient( 180deg, #FFFFFF, #DFDFDF );
				background: #E5E5E5 linear-gradient( 180deg, #FFFFFF, #DFDFDF );
			
				text-shadow: #FFFFFF 0px 1px 0;
			
				text-align: center;
			
				outline: none;
			
				z-index: 1;
			}
			
			.button:hover {
				border-color: #9A9A9A;
			
				-webkit-box-shadow: 0px 0px 2px #A0A0A0;
				box-shadow: 0px 0px 2px #A0A0A0;
			}
			
			.button:active {
				color: #555555;
			
				text-shadow: #FFFFFF 0px 1px 0;
			
			
				border-color: #9A9A9A;
			
				background: #E6E6E6 none;
			
				-webkit-box-shadow: inset 0 0 2px #D0D0D0;
				box-shadow: inset 0 0 2px #D0D0D0;
			}




			.tipUpper {
				display: inline-block;
				position: absolute;
				opacity: 0.9;
				z-index: 10000;
				border: solid 1px #FFFFFF;
				border-radius: 4px;
				margin-top: 16px;
				background-color: #000000;

				white-space: nowrap;
			}

			.tipUpper .ugol {
				font-size: 1px;
				position: absolute;
				top: -15px;
				left: 16px;
				border-width: 0;
				border-top: 15px solid transparent;
				border-left: 15px solid #FFFFFF;
			}

			.tipUpper .ugolI {
				font-size: 1px;
				border-width: 0;
				border-top: 13px solid transparent;
				border-left: 13px solid #000000;
				position: absolute;
				top: -13px;
				left: 17px;
			}

			.tipUpper .msg {
				font-size: 80%;
				margin: 3px 5px 3px 5px;
				color: #FFFFFF;
				text-align: left;
			}

			/* IE Fixing */
			*html .tipUpper {
				*display: inline;
				zoom: 1;
				filter: alpha( opacity = 90 );
			}

			*html .tipUpper .ugol, *html .tipUpper .ugolI {
				border-top-color: #FF00FF;
				filter:progid:DXImageTransform.Microsoft.Chroma(color='#FF00FF');
				zoom: 1;
			}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<h1><?php echo( HEADER ); ?></h1>

			<div id="msgsDialog" class="block">
				<div id="msgsContent">
					<?php chatOut(); ?>
				</div>

				<label class="options first"><input id="autoScroll" type="checkbox" checked="checked" /> прокручивать вниз</label>
				<label class="options"><input id="playSound" type="checkbox" checked="checked" /> звук</label>
				<label class="options"><input id="autoHeight" type="checkbox" checked="checked" /> авторазмер ввода</label>

				<div class="ct"></div>
				<div class="cb"></div>
			</div>
			<br />
			<br />
			<form action="" method="post" id="sendForm">
				<div id="sendDialog" class="block2">
					<input type="text" name="name" value="<?php echo( $name ); ?>" maxlength="<?php echo( MAXUSERNAMELEN ) ?>" placeholder="Имя" />
					<textarea name="text" placeholder="Текст" style="margin-top: 0.5em;" maxlength="<?php echo( MAXUSERTEXTLEN ); ?>"></textarea>
					<input type="submit" value="отправить" class="button" title="ctrl + enter" id="submit"/>
					<div class="ad"></div>
				</div>
			</form>
		</div>

		<script type="text/javascript">
		//<![CDATA[
			( function() {
				var msgsDialog = document.getElementById( "msgsDialog" );
				var sendDialog = document.getElementById( "sendDialog" );
				var submit = document.getElementById( "submit" );

				var msgs = document.getElementById( "msgsContent" );
				var oAS = document.getElementById( "autoScroll" );
				var oSND = document.getElementById( "playSound" );
				var oAH = document.getElementById( "autoHeight" );
				var f = document.getElementById( "sendForm" );
				var name = f.elements.name;
				var text = f.elements.text;

				function ah( el, maxH, state ) {									
					if ( arguments.length === 1 ) {
						if ( el._ah_ ) el._ah_();
						return;
					}

					if ( el._ah_ ) de( el, "input", el._ah_ );
					delete( el._ah_ );
					el.style.height = "auto";

					if ( state ) {
						el.style.boxSizing = "border-box";
						var h = el.offsetHeight;
						var dh = h - el.clientHeight;

						el._ah_ = function() {							
							while ( true ) {
								t = el.offsetHeight - 16;
								el.style.height = t + "px";
								if ( t < h || el.scrollHeight > el.clientHeight ) break;
							}

//							el.style.height = "auto";
							var nh = el.scrollHeight + dh;
							if ( maxH && nh > maxH ) nh = maxH;
							el.style.height = nh + "px";
						};

						ae( el, "input", el._ah_ );
						el._ah_();
					}
				}
				if ( oAH.checked ) ah( text, 500, true );

				var msgsDialogWaiter = WAITER( msgsDialog );
				var sendDialogWaiter = WAITER( sendDialog );

				var snd = null;
				try {
					snd = new Audio( "data:audio/mpeg;base64,//uQxAAAEvGLIVT0AAuBtax3P2QCIAAIAGWUC+HkqfLeTs0zTQg7wL4BGCfQQ3A1BYDjCA4BoHgpWlFh2Lu+QLnkCgpRYu+4uL2QDQPDIT0FBQyRQUpwbh+fo7i4uLvoKA3BufBAoYlehAoKClOKChiIlbigokli4u8O4u73oh7v/6PcIKChlC6J//1vcEChhYNAaGU7u717u78PoZRYdnkALgvHkClOe/ARmPZVAwGIyHA4FQkCQJBAMAHAEzABwATHDWRgjAHQYFwJEe8X1jOkkG4y04RCJQANqNrMDJKMgDIMDRFDAxXiDAy/CIAwrhVUWkuBgVCABqvXuBybuyBzvSGtzQraTgYJkCgaaxbgYrAVAaNjqAZCANLHNWvS4GC0E4GQARAAgNQMHYCwspBusxOtr/DbAs2Q4tCcxlxZZ5qpw//nS+WTcwPjkEQ/qf/m9y4aLD4xY0FCM/1vr/+DY2I0QIoLjKBoVwKACAwIAAAUBGWCCBZIDYgy509qN0uj/1/Pc3uTBLf/LAI423K5bICDMzK72SSB0piCDVSm//uSxAoDzHSZNbzGADAAADSAAAAEJz44gRLSUSRJEVS0SgAhJcOjJdZkxJsZJBqIqloyMjISTExMTExPVtWTkSRJMXWjISls2t81WrfqtqMBoOCJ4Kgqs6Ij3/8t/g1///ywcLVMQU1FMy45OC40VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVUxBTUUzLjk4LjRVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVf/7ksQ5A8AAAaQAAAAgAAA0gAAABFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVMQU1FMy45OC40VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVX/+5LEOQPAAAGkAAAAIAAANIAAAARVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV" );
				}
				catch( e ) {
					snd = null;
					console.log( "can't play sounds" );
				}
				
				function ae( obj, event, handler ) {
					if ( typeof( obj.addEventListener ) != 'undefined' ) obj.addEventListener( event, handler, true );
					else if ( typeof ( obj.attachEvent ) != 'undefined' ) obj.attachEvent( 'on' + event, handler, true );
				}

				function de( obj, event, handler ) {
					if ( typeof( obj.removeEventListener) != 'undefined' ) obj.removeEventListener( event, handler, true );
					else if ( typeof( obj.detachEvent ) != 'undefined' ) obj.detachEvent( 'on' + event, handler );
				}

				function post( url, reqParams, handler ) {
					var XMLo;

					if ( window.XMLHttpRequest ) {
						try { XMLo = new XMLHttpRequest(); }
						catch ( e ) { XMLo = null; }
					} else if ( window.ActiveXObject ) {
						try { XMLo = new ActiveXObject( "Msxml2.XMLHTTP" ); }
						catch ( e ) {
							try { XMLo = new ActiveXObject( "Microsoft.XMLHTTP" ); }
							catch ( e ) { XMLo = null; }
						}
					}

					if ( XMLo == null ) return null;

					XMLo.open( "POST", url, true );

					XMLo.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
					if ( reqParams ) {
						var prm = "";
						for ( var i in reqParams ) prm += "&" + i + "=" + encodeURIComponent( reqParams[i] );
						reqParams = prm;
						//XMLo.setRequestHeader( "Content-Length", reqParams.length );
					}
					else {
						reqParams = " ";
						//XMLo.setRequestHeader( "Content-Length", 1 );
					}
					XMLo.setRequestHeader( "X-Requested-With", "XMLHttpRequest" );
					XMLo.setRequestHeader( "Accept", "*/*" );

					XMLo.onreadystatechange = function() {
						if ( XMLo.readyState == 4 ) {
							if ( XMLo.status == 200 || XMLo.status == 0 ) {
								handler( true, XMLo.status, XMLo.responseText, ( XMLo.responseXML ? XMLo.responseXML.documentElement : null ) );
							}
							else {
								handler( false, XMLo.status, XMLo.responseText );
							}

							delete XMLo;
							XMLo = null;
						}
					};

					XMLo.send( reqParams );

					return ( XMLo != null );
				}

				function fade( o, opts, dontStartNow ) {
					var ov, ob, oe, os, t;

					function th() {
						ov += os;
						if ( ( os > 0 && ov >= oe ) || ( os < 0 && ov <= oe ) ) {
							ov = oe;
							clearInterval( t );
							t = null;
						}

						o.style.opacity = ov;

						if ( !t && opts.hasOwnProperty( "handler" ) ) opts.handler( true, fs, o );
					}

					function init() {
						os = opts.hasOwnProperty( "os" ) ? Math.abs( opts.os ) : 0.1;

						if ( !opts.hasOwnProperty( "delay" ) ) opts.delay = 30;

						if ( !opts.hasOwnProperty( "ob" ) ) {
							ob = parseFloat( o.style.opacity );
							if ( isNaN( ob ) ) ob = 1;
						}
						else {
							ob = opts.ob;
							o.style.opacity = ob;
						}
						ov = ob;

						if ( !opts.hasOwnProperty( "oe" ) ) {
							oe = parseFloat( o.style.opacity );
							if ( isNaN( oe ) ) oe = 1;
						}
						else oe = opts.oe;

						if ( ob > oe ) os = -os;

						if ( ob != oe ) t = setInterval( th, opts.delay );
					}

					var fs = {
						get: function() {
							return {
								opts:	opts,
								ov:		ov,
								ob:		ob,
								oe:		oe,
								os:		os
							};
						},

						stop: function( end, dontNotify ) {
							if ( !t ) return;

							clearInterval( t );
							t = null;
							if ( end ) o.style.opacity = oe;

							if ( dontNotify !== true && opts.hasOwnProperty( "handler" ) ) opts.handler( true, fs, o );
						},

						start: function( restart, newOpts, dontNotify ) {
							if ( t ) return;

							if ( newOpts ) opts = newOpts;

							if ( restart ) {
								init();
								if ( dontNotify !== true && opts.hasOwnProperty( "handler" ) ) opts.handler( false, fs, o );
							}
							else t = setInterval( th, opts.delay );
						}
					};

					if ( dontStartNow !== true ) fs.start( true );
					return fs;
				}

				var tipUpper = (function() {
					var lastTip = null;

					return function( o, html, ax, ay ) {
						if ( ax == undefined ) ax = 0;
						if ( ay == undefined ) ay = -5;

						function getCords( elem ) {
							var box = elem.getBoundingClientRect();

							var body = document.body;
							var docEl = document.documentElement;

							var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
							var scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;

							var clientTop = docEl.clientTop || body.clientTop || 0;
							var clientLeft = docEl.clientLeft || body.clientLeft || 0;

							var top  = box.top +  scrollTop - clientTop;
							var left = box.left + scrollLeft - clientLeft;

							return { top: Math.round(top), left: Math.round(left) };
						}

						function attachEvents( tip, o ) {
							detachEvents( tip );
							tip.eh = function() {
								detachEvents( tip );
								f.stop();
								lastTip = null;
								f.start(
									true,
									{
										oe: 0,
										os: 0.1,
										handler: function( over, f ) {
											if ( over ) {
												tip.style.display= "none";
												tip.parentNode.removeChild( tip );
											}
										}
									},
									true
								);
							};
							tip.o = o;

							ae( o, "change", tip.eh );
							ae( document, "mousedown", tip.eh );
							ae( document, "keydown", tip.eh );
						}

						function detachEvents( tip ) {
							if ( !tip.eh ) return;

							de( tip.o, "change", tip.eh );
							de( document, "mousedown", tip.eh );
							de( document, "keydown", tip.eh );
						}

						if ( lastTip ) lastTip.eh();

						var t = document.createElement( "div" );
						t.className = "tipUpper";
						t.innerHTML = '<div class="ugol"></div><div class="ugolI"></div><div class="msg">' + html + '</div>';
						var c = getCords( o );
						t.style.left = ( c.left + ax ) + "px";
						t.style.top = ( c.top + o.offsetHeight + ay ) + "px";
						var f = fade(
							t,
							{
								ob: 0,
								oe: 1,
								os: 0.1
							}
						);

						document.body.appendChild( t );

						attachEvents( t, o );
						o.focus();

						lastTip = t;
					};
				})();

				function WAITER( o ) {
					var count = 0;
					var w = document.createElement( "div" );
					remove();
					var f = fade( w, null, true );
					var oMax = 0.3;
					var t = null;


					function th() {
						clearTimeout( t );
						t = null;

						if ( count > 0 ) {
							w.style.visibility = "hidden";
							if ( !w.parentNode ) {
								if ( !o.style.position ) o.style.position = "relative";
								o.appendChild( w );
							}
							w.className = "waiter waiterProgress";
							f.start( true, { ob: 0, oe: oMax, os: 0.05 }, true );
							w.style.visibility = "visible";
						}
						else remove();
					}

					function remove() {
						if ( w.parentNode ) w.parentNode.removeChild( w );
						w.className = "waiter";
						w.style.opacity = 0;
					}

					return {
						show: function( state, always ) {
							var full = w.className.indexOf( "waiterProgress" ) >= 0;

							if ( state ) {
								if ( t ) clearTimeout( t );

								if ( count == 0 ) {
									if ( !w.parentNode && always !== false ) {
										if ( !o.style.position ) o.style.position = "relative";
										o.appendChild( w );
									}
									if ( full ) {
										f.stop( false, true );
										f.start( true, { oe: oMax, os: 0.05 }, true );
									}
								}

								if ( !full ) t = setTimeout( th, 500 );
								count++;
							}
							else {
								if ( count > 0 ) {
									if ( count == 1 ) {
										count = 0;
										if ( t ) {
											clearTimeout( t );
											t = null;
										}

										if ( full ) {
											f.stop( false, true );
											f.start(
												true,
												{
													oe: 0,
													os: 0.05,
													handler: remove
												},
												true
											);
										}
										else remove();
									}
									else count--;
								}
							}
						},

						isShow: function() {
							return count > 0 ;
						}
					};
				}

				function scrollBottom() {
					var os = msgs.onscroll;
					msgs.onscroll = function( e ) {
						if ( !e ) e = window.event;
						if ( e.preventDefault ) e.preventDefault();
						if ( e.stopPropagation ) e.stopPropagation();

						return false;
					};
					msgs.scrollLeft = 0;
					msgs.scrollTop = msgs.scrollHeight;
					setTimeout( function() { msgs.onscroll = os; }, 10 );
				}

				function insertAtCursor( o, val ) {
					if ( document.selection ) {
						o.focus();
						sel = document.selection.createRange();
						sel.text = val;
					}
					else if ( o.selectionStart || o.selectionStart == '0' ) {
						var startPos = o.selectionStart;
						var endPos = o.selectionEnd;
						o.value = o.value.substring( 0, startPos ) + val + o.value.substring( endPos, o.value.length );
					}
					else o.value += val;
				}

				var refresh = (function() {
					var lastMod = "<?php echo( $lastMod ); ?>";

					return function( params, handler ) {
						if ( !params ) params = {};
						if ( !params.hasOwnProperty( "lastMod" ) ) params.lastMod = lastMod;

						post(
							window.location.toString(),
							params,
							function( state, status, txt ) {
								if ( !state ) {
									tipUpper( msgsDialog, "Ошибка сервера: " + status );
									txt = undefined;
								}

								if ( txt !== undefined ) {
									var p = txt.indexOf( "\n" );
									if ( p > 0 ) {
										var s = /^([a-z]+):(\d+)$/i.exec( txt.substring( 0, p ) ), lm;
										if ( s ) {
											lm = s[2];
											s = s[1];

											txt = txt.substring( p + 1 );

											if ( s == "NONMODIFIED" ) txt = undefined;
											if ( s == "OK" ) lastMod = lm;
										}
									}

									if ( txt !== undefined ) {
										msgs.innerHTML = txt;
										if ( oAS.checked ) scrollBottom();
										
										if ( oSND.checked ) {
											if ( snd ) {
												snd.pause();
												snd.currentTime = 0;
												snd.play();
											}
										}
									}
								}

								if ( handler ) handler( state, status, txt );
							}
						);
					};
				})();

				var poll = (function() {
					var t = null;
					var inProgress = false;

					var rq = function() {
						if ( inProgress ) return;

						inProgress = true;
						msgsDialogWaiter.show( true, false );
						refresh(
							{ mode: "list" },
							function( state, status, txt ) {
								msgsDialogWaiter.show( false );
								inProgress = false;
								poll( false, true );
							}
						);
					};

					return function( refreshNow, rewait ) {
						if ( rewait === true ) {
							if ( t ) clearTimeout( t );
							t = setTimeout( rq, <?php echo( REFRESHTIME ); ?> );
						}

						if ( refreshNow === true ) rq();
					};
				})();

				oAS.onclick = function() {
					if ( this.checked ) scrollBottom();
				};

				oSND.onclick = function() {
					if ( oSND.checked === false ) {
						if ( snd ) {
							snd.pause();
							snd.currentTime = 0;
						}
					}
				};

				oAH.onclick = function() {
					ah( text, 500, oAH.checked );
				};
				
				f.onsubmit = function() {
					if ( /^\s*$/.test( name.value ) ) {
						tipUpper( name, "Пожалуйста, введите свое имя" );
						return false;
					}

					if ( /^\s*$/.test( text.value ) ) {
						tipUpper( text, "Пожалуйста, введите текст" );
						return false;
					}

					sendDialogWaiter.show( true );
					msgsDialogWaiter.show( true, false );

					refresh(
						{
							mode: "post",
							lastMod: 0,
							name: name.value,
							text: text.value
						},
						function( state, status, txt ) {
							if ( state ) {
								text.value = "";
								ah( text );
							}
							sendDialogWaiter.show( false );
							msgsDialogWaiter.show( false );
						}
					);

					return false;
				};

				msgs.onclick = function( e ) {
					if ( !e ) e = window.event;

					var s = e.srcElement || e.target;
					if ( s.tagName == "A" ) return;

					for ( var i = 0; i < 4; i++ ) {
						if ( !s || s.className.indexOf( "msg" ) >= 0 ) break;
						s = s.parentNode;
					}

					if ( s ) {
						var ps = s.getElementsByTagName( "span" );
						var name = ps[0].innerText || ps[0].textContent;
						var misc = ps[1].innerText || ps[1].textContent;
						var txt = "";
						s = s.firstChild.nextSibling;
						while ( s ) {
							if ( s.tagName ) txt += s.tagName == "BR" ? "\n" : s.innerText || s.textContent;
							else txt += s.nodeValue;
							s = s.nextSibling;
						}

						if ( text.value ) text.value += "\n";
						text.value += ">" + name + " " + misc + "\n" + txt.replace( /(^|\n)/g, "$1>" );
					}
				};

				msgs.onscroll = function() {
					oAS.checked = false;
				};

				name.onkeydown = text.onkeydown = function( e ) {
					if ( sendDialogWaiter.isShow() ) return;
					if ( !e ) e = window.event;
					if ( e.keyCode === 13 && e.ctrlKey ) f.onsubmit();
				};

				if ( oAS.checked ) scrollBottom();

				text.focus();

				poll( false, true );
			} )();
		//]]>
		</script>
	</body>
</html>
