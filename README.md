<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style>
 .LiveChat{
 position:absolute;
 bottom:0%;
 height:10%;
 background-color:red;
 }
 </style>
 <script>
 $(document).ready(function()
 {
    $("#chatBtn").click(function()
    {
        $(".LiveChat").css("height","30%");
    });
 });
 </script>
</head>
<body>
<div class="LiveChat">
<button id="chatBtn">Live chat</button>
<p>rest of details below</p>
</div>

</body>
</html>
