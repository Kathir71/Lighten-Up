<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="nav.css">
	<link rel = 'stylesheet' href = 'quiz_page.css'>
    <title>receive data</title>
</head>

<body style="overflow-x:hidden">

<?php

$quiz_name = $_POST['quiz_name'];
$author_name = $_POST['author_name'];
$quiz_description = $_POST['quiz_description'];
$num_of_qns = $_POST['num_of_qns'];
$questions = array();
$option_a = array();
$option_b = array();
$option_c = array();
$option_d = array();
$correct_ans = array();
$scores = array();

for( $i = 0 ; $i < $num_of_qns ; $i++ ) {
	$text_area_num = "textarea_" . $i+1;
	$questions[$i] = $_POST[$text_area_num];
	$option_a_num = "option_a" . $i+1;
	$option_a[$i] = $_POST[$option_a_num];
	$option_b_num = "option_b" . $i+1;
	$option_b[$i] = $_POST[$option_b_num];
	$option_c_num = "option_c" . $i+1;
	$option_c[$i] = $_POST[$option_c_num];
	$option_d_num = "option_d" . $i+1;
	$option_d[$i] = $_POST[$option_d_num];
	$correct_ans_num = "radio" . $i+1;
	$correct_ans[$i] = $_POST[$correct_ans_num];
	$score_num = "score_".$i+1;
	$scores[$i] = $_POST[$score_num];
}

$server = 'localhost';
$user = 'root';
$password = "";
$database = 'quick_quiz';
$connection = mysqli_connect($server, $user, $password);
mysqli_select_db($connection, $database);

if(!$connection) {
	echo "<h3> ERROR404. Connection not found </h3> ";
}

$insert_into_quiz_list = "INSERT INTO quiz_list (quiz_name, author_name, quiz_description) VALUES ('$quiz_name', '$author_name', '$quiz_description')";
if(!mysqli_query($connection, $insert_into_quiz_list)) {
	echo "ERROR IN INSERTING" . mysqli_error($connection);
}
$select_quiz_id = "SELECT * FROM quiz_list";
$quiz_id = mysqli_query($connection, $select_quiz_id);
if(!$quiz_id) {
	echo "ERROR IN SELECTING QUIZ_ID" . mysqli_error($connection);
}

$count_list = 0;
while( $row = mysqli_fetch_assoc($quiz_id) ) {
	$count_list++;
}

for( $i = 0 ; $i < $num_of_qns ; $i++ ) {
	$insert_questions = "INSERT INTO question_table VALUES ($count_list, '$quiz_name', $i+1, '$questions[$i]', '$option_a[$i]', '$option_b[$i]', '$option_c[$i]', '$option_d[$i]','$scores[$i]')";
	if(!mysqli_query($connection,$insert_questions)) {
		echo "ERROR INSERTING QUESTION " . $i+1;
	}
	$insert_user_answers = "INSERT INTO user_input VALUES ($count_list, '$quiz_name', $i+1, 0)";
	if(!mysqli_query($connection,$insert_user_answers)) {
		echo "ERROR MAY OCCUR WHILE USER INPUTS ANSWERS AT QUESTION " . $i+1;
	}
}

for( $i = 0 ; $i < $num_of_qns ; $i++ ) {
	$insert_answers = "INSERT INTO answer_table VALUES ($count_list, '$quiz_name', $i+1, '$correct_ans[$i]')";
	if(!mysqli_query($connection,$insert_answers)) {
		echo "ERROR INSERTING ANSWER " . $i+1;
	}
}

?>

	<nav>
			<div class="logo">
				<img src="logo.jpeg" width="70vw" height="67vh"></img>&emsp; Lighten Up
			</div>
	</nav>
	<div class="success">
			<img src="emoji1.png" width="25%" height="25%"><img src="emoji2.png" width="25%" height="25%" align="right"><br>
			<center>
				QUIZ CREATED SUCCESSFULLY <br><br><br>
				<a href="index.html"><button type="button" id="success1"><b>GO BACK TO HOME PAGE</b></button>
			</center>
	</div>
</body>

</html>