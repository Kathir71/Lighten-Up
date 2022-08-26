<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="instructions.css">
    <title> Instructions_Page </title>
</head>

<body>
<?php 
	session_start();
	$quizid = $_POST['quiz_id_set'];
	$_SESSION['quiz_id'] = $_POST['quiz_id_set'];
	$quizname = $_POST['quiz_name_set'];
	$_SESSION['quiz_name'] = $_POST['quiz_name_set'];
	$authorname = $_POST['author_name_set'];
	$_SESSION['author_name'] = $_POST['author_name_set'];
	include('quiz_config.php');
	$numofqns = $_SESSION['number_of_questions'];
	$score_total = $_SESSION['total_score'];
 ?>
 
 <!-- Add on stylings for instruction -->
 <div class='quiz_details'>
	<h3><?php echo $quizname?> </h3>
	<p> <?php echo $authorname?> </p>
 </div>
 
 <div class='instructions'> 
	<ol>
		<li> THE QUIZ CONTAINS A TOTAL OF <?php echo $numofqns ?> QUESTIONS </li> <br>
		<li> THE QUIZ CONTAINS A TOTAL SCORE OF <?php echo $score_total ?> MARKS </li> <br>
		<li> YOU WILL HAVE 30 SECONDS TO ANSWER EACH QUESTION </li> <br>
		<li> ONCE YOU HAVE ANSWERED A QUESTION, CLICK ON THE NEXT BUTTON TO GO TO THE NEXT QUESTION </li> <br>
		<li> IF YOU HAVE NOT CLICKED ON NEXT / SUBMIT BUTTON BEFORE THE SPECIFIED TIME, THE QUESTION GETS AUTOMATICALLY SUBMITTED </li> <br>
		<li> THERE IS NO NEGATIVE MARKING FOR ANY QUESTION </li> <br>
		<li> ONCE YOU HAVE COMPLETED THE QUIZ, YOU WILL BE ABLE TO SEE THE SCORES AND ANALYSIS OF EACH QUESTION </li> <br>
	</ul>
	<h3> ALL THE BEST !!! </h3> 
 </div>
 
<button onclick='document.location="quiz_page.php"' id = 'start-btn'> START QUIZ </button> 
 
</body>

</html>