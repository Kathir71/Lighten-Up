<!-- this file contains code for selecting the appropriate questions,quiz-name,author-name from the database table-->
    <?php
    $dynamic_quiz_id = $_SESSION['quiz_id'];
    $dynamic_quiz_name = $_SESSION['quiz_name'];
	$number_of_questions = 0;
	$total_score = 0;
    $server = 'localhost';
    $user = 'root';
    $password = "";
    $dbname = 'quick_quiz' ;
    $connection = mysqli_connect($server, $user, $password);
    mysqli_select_db($connection, $dbname);
    if (!$connection) {
        echo 'Connection to database failed';
    }
    $select_questions_query = "SELECT question AS q,option_a AS a,option_b AS b,option_c AS c,option_d AS d,score AS sc FROM question_table where quiz_id ='$dynamic_quiz_id' and quiz_name = '$dynamic_quiz_name'";
    $select_author_query = "SELECT quiz_name AS qn , author_name AS tn FROM quiz_list WHERE quiz_id = '$dynamic_quiz_id' and quiz_name = '$dynamic_quiz_name'";
    $result1 = mysqli_query( $connection, $select_questions_query);
    $result2 = mysqli_query($connection,$select_author_query);
    $multi_assoc_array = array();
    while ($row1 = mysqli_fetch_assoc($result1)) {
    array_push($multi_assoc_array, $row1);
    $number_of_questions++;
	$total_score += $row1['sc'];
    }
    $row2 = mysqli_fetch_assoc($result2);//as we are selecting only one row no loop is needed
    $_SESSION['questions_array'] = $multi_assoc_array;//passing
    $_SESSION['names_array'] = $row2;
    $_SESSION['number_of_questions'] = $number_of_questions;
	$_SESSION['total_score'] = $total_score;
    ?>