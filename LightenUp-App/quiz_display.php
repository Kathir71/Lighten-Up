<!-- just buttons are displayed, onclick to be added -->

<! Doctype html>

<html>

<head> 
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> QUIZ DISPLAY </title>
	<link rel="stylesheet" href="nav.css">
	<link rel="stylesheet" href="cards.css">
</head>

<body>

<nav>
			<div class="logo">
				<img src="logo.jpeg" width="70vw" height="67vh"></img>&emsp; Lighten Up
			</div>
</nav>

<?php

	$server = 'localhost';
    $user = 'root';
    $password = "";
    $dbname = 'quick_quiz' ;
    $connection = mysqli_connect($server, $user, $password);
    mysqli_select_db($connection, $dbname);
    if (!$connection) {
        echo 'Connection to database failed';
    }

	$quiz_list_select = "SELECT * from quiz_list";
	$quiz_list_result = mysqli_query($connection, $quiz_list_select);
	$quiz_list_array = array();
	$quiz_list = array();
	$no_of_quiz = 0;
	while($quiz_list_array = mysqli_fetch_assoc($quiz_list_result)) {
		$no_of_quiz++;
		array_push($quiz_list, $quiz_list_array);
	}

?>
<form action="instructions_page.php" method="POST" id="form_values">
<input type="text" id="quiz_id_set" name="quiz_id_set" value="" style="display:none">
<input type="text" id="quiz_name_set" name="quiz_name_set" value="" style="display:none">
<input type="text" id="author_name_set" name="author_name_set" value="" style="display:none">
</form>
<div class="container">
</div>
<script type="text/javascript">
	var number_of_quiz = <?php echo $no_of_quiz ?>;
	var quiz_name_array = <?php echo json_encode($quiz_list); ?>;
	let i = 1;
	window.onload = display_buttons();
	function display_buttons() {	
	for(i = 1 ; i <= number_of_quiz; i++) {
		var y = "<div class = 'card' onclick='send_id(quiz_name_array[" + i + "-1].quiz_id)'>" + '<h1>'+quiz_name_array[i-1].quiz_name + '</h1><p>'+ quiz_name_array[i-1].quiz_description + "</p><p id = 'author'> Made by " + quiz_name_array[i-1].author_name + "</p></div>";
		document.querySelector(".container").insertAdjacentHTML("beforeend",y);
	}
	}
	
	function send_id(j) {
		document.getElementById('quiz_id_set').value = quiz_name_array[j-1].quiz_id;
		document.getElementById('quiz_name_set').value = quiz_name_array[j-1].quiz_name;
		document.getElementById('author_name_set').value = quiz_name_array[j-1].author_name;
		document.getElementById('form_values').submit();
	}
	
</script>

</body>

</html>