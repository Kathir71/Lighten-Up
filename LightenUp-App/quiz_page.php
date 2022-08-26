<!-- This is the actual quiz page-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = 'stylesheet' href = 'quiz_page.css'>
    <title>The quiz page</title>
</head>

<body>
<?php 
	session_start();
	include('quiz_config.php');
?>
<section class="hero">
<div class="timer_container">
<p id = 'qn_no'></p>
<div class="circle" id="countdown"></div>
</div>
<form action="receive_data.php" method = 'POST'>
<p id="question"></p>
<div class="options">
<input type="radio" name="option_list" id="a" value = 1>
<label for="a" class = 'option'></label>
<input type="radio" name="option_list" id="b"value = 2>
<label for="b"class = 'option'></label>
<input type="radio" name="option_list" id="c"value = 3>
<label for="c" class = 'option'></label>
<input type="radio" name="option_list" id="d"value = 4>
<label for="d" class = 'option'></label>
</div>
<input type="text" name="answers_string" id="important" value="" style = 'display:none'>
<input type="submit" value="submit form" id="submit">
</form>
<button id="auto_next" onclick="auto_timer();">AUTO</button>
<div class="bottom_container">
<div id="score"></div>
<button onclick = 'next_timer();' id = 'next-btn'>Next</button>
</div>
</section>
<br><br>
<?php
include 'script.php';
?>
</body>
</html>