<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "quick_quiz";
$conn = mysqli_connect($server, $user, $password, $database);
if (!$conn) {
	echo "<h3> ERROR 404. NOT FOUND </h3>";
}
$quiz_display = "SELECT A.question_id, A.correct_option, B.question,B.option_a,B.option_b,B.option_c,B.option_d ,B.score,C.user_answer
FROM answer_table A,question_table B,user_input C 
WHERE  A.quiz_id = '$quiz_id' AND A.quiz_name = '$quiz_name' AND A.question_id = B.question_id AND A.question_id = C.question_id AND A.quiz_name = B.quiz_name AND C.quiz_name = A.quiz_name AND A.quiz_id = B.quiz_id AND C.quiz_id = A.quiz_id AND B.quiz_id = C.quiz_id";
$result = mysqli_query($conn, $quiz_display);
$arr = array();
$score = 0;
$tot_score = 0;
$full_score = 0;
#calculating the total score
if ($result) {
	while ($arr = mysqli_fetch_assoc($result)) {
		$score = 0;
		if ($arr['user_answer'] == $arr['correct_option']) {
			$score = $arr['score'];
		} else if ($arr['user_answer'] == 0) {
			#do nothing	
		}		
		$tot_score += $score;
		$full_score += $arr['score'];
	}
	
}
echo "<div class = 'scorecard'>";
echo "<h3> YOUR TOTAL SCORE IS :  " . $tot_score . " / ".$full_score."</h3>". "</div>";
$result = mysqli_query ($conn, $quiz_display);
$other_answers = "<span class = 'others'>";
$correct_answer = "<span class = 'correct'>";
$wrong_answer = "<span class = 'wrong'>";
$span_close = "</span>";
echo "<div class = 'container'>";
$arr = array();
while ($arr = mysqli_fetch_assoc($result)) {
	$status = '';
	$score = 0;
	$user_values = array($other_answers, $other_answers, $other_answers, $other_answers);
	$user_values[$arr['correct_option'] - 1] = $correct_answer;
	if ($arr['user_answer'] == $arr['correct_option']) {
		$status = 'Correct';
		$score = $arr['score'];
	} else if ($arr['user_answer'] == 0) {
		$status = 'Unanswered';
	} else {
		$status = 'Wrong';
		$user_values[$arr['user_answer']-1] = $wrong_answer;
	}
	echo "<div class = 'element'><div class = 'info'><p class = 'score'>Score: ".$score."/".$arr['score']."</p>"."<p class = 'status'>Status : ". $status . "</p></div><div class = 'question'>" . $arr['question_id'] . " . "  . $arr['question'] . "</div>";
	echo "<div class = 'options'>" . $user_values[0] . "<p>" . $arr['option_a'] . "</p>" . $span_close . $user_values[1] . "<p>" . $arr['option_b'] . "</p>" . $span_close . $user_values[2] . "<p>" . $arr['option_c'] . "</p>" . $span_close . $user_values[3] . "<p>" . $arr['option_d'] . "</p>" . $span_close;
	echo "</div>"."</div>";
}
echo "</div>";

?>
