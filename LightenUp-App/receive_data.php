<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = 'stylesheet' href = 'score.css'>
    <title>receive data</title>
</head>

<body>
    <?php
    session_start();
    $answers_string = $_POST['answers_string'];
    $answers_array = str_split($answers_string);
    $number_of_questions = $_SESSION['number_of_questions'];
    $quiz_name = $_SESSION['quiz_name'];
    $quiz_id = $_SESSION['quiz_id'];
    #not entirely sure if we need the for loop 
    for ($i = 0; $i < count($answers_array); $i++) {
        $answers_array[$i] = (int)$answers_array[$i];
    }
    $server = 'localhost';
    $user = 'root';
    $password = "";
    $dbname = 'quick_quiz';
    $connection = mysqli_connect($server, $user, $password);
    mysqli_select_db($connection, $dbname);
    if (!$connection) {
        echo 'Connection to database failed';
    }
    #inserting into the database
    $i = 0;
    while ($i < $number_of_questions) {
        $insertion_query = "UPDATE user_input SET user_answer = '$answers_array[$i]' WHERE quiz_id = '$quiz_id' and quiz_name = '$quiz_name' and question_id = $i+1";
        if (!mysqli_query($connection, $insertion_query)) {
            echo "Error in insertion" . mysqli_error($connection);
        }
        $i++;
    }
    include('myscore.php');
    ?>
	
	<center><a href="index.html"><button type="button" id="backhome"><b>HOME</b></button></a></center>

</body>

</html>