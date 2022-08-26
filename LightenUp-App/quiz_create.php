<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Create quiz </title>
	<link rel="stylesheet" href="nav.css">
	<link rel="stylesheet" href="create.css">
	<link rel="stylesheet" href="nav2.css">
</head>
<body>

<nav>
			<div class="logo">
				<img src="logo.jpeg" width="70vw" height="67vh"></img>&emsp; Lighten Up
			</div>
</nav>

<form action="update_quiz_questions.php" method="POST">

	<table class = 'quiz_details'>
	 <tr> <th colspan='2' id = 'heading'> QUIZ DETAILS </th> </tr>
	 <tr> <td class="left-col"> QUIZ NAME : </td> 
		  <td> <input type="text" name="quiz_name" value="" required placeholder="Enter the quiz name" autocomplete="off"/> </td>
	 </tr>
	 <tr> <td class="left-col"> AUTHOR NAME : </td>
		  <td> <input type="text" name="author_name" value="" required placeholder="Enter your name" autocomplete="off"/> </td>
	 </tr>	  
	 <tr>  <td class="left-col"> DESCRIPTION: </td>
	       <td> <textarea  name="quiz_description" value=""  rows = '10' cols = '15' required placeholder="Give a quiz description less than 150 characters"  autocomplete="off"> </textarea> </td>
	 </tr>
	</table>
	<div class="instructions">
		INSTRUCTIONS: Fill out the questions and the options below it and also select the option containing the correct answer.		
	</div>
	
<div class="container">
	<div id="questions">
	<p id="qn1">
		<table class = 'question_details'>
		 <tr> <th class = 'left-col'> QUESTION 1 </th> <td> <textarea name="textarea_1"  value="" required rows = '10' cols = '15'> </textarea> </td> </tr>
		 <tr> <td class = 'left-col'> <input type="radio" name="radio1" value="1" required/> OPTION A </td>
			  <td> <input type="text" name="option_a1" required autocomplete="off"/> </td>
		 </tr>
		 <tr> <td class = 'left-col'> <input type="radio" name="radio1" value="2"> OPTION B </td>
			  <td> <input type="text" name="option_b1" required autocomplete="off"/> </td>
		 </tr>
		 <tr> <td class = 'left-col'> <input type="radio" name="radio1" value="3"> OPTION C </td>
			  <td> <input type="text" name="option_c1" required autocomplete="off"/> </td>
		 </tr>
		 <tr> <td class = 'left-col'> <input type="radio" name="radio1" value="4"> OPTION D </td>
			  <td> <input type="text" name="option_d1" required autocomplete="off"/> </td>
		 </tr>
		 <tr>
		 <td class="left-col">Enter the score</td>
		 <td><input type="number" name="score_1" id="score"  min = '1' max = '100' required></td>
		 </tr>
		</table>
	</p>
	</div>
</div>

<input type="text" id="num_of_qns" name="num_of_qns" value="1" style="display:none">
<div class="btn-grp">
	<button id = 'create_btn'> CREATE </button>
	<button onclick="add_qn();" id = 'add_btn'> ADD ONE MORE QUESTION </button>
</div>
</form>
</body> 
<script type="text/javascript">
var count = 1;
function add_qn() {
	count++;
	var x = "<table class = 'question_details'> <tr> <th> QUESTION " + count + "</th> <td>  <textarea name='textarea_"+count+"' rows='10' cols='15' value='' required> </textarea> </td> </tr>";
	x +=  "<tr> <td class = 'left-col'> <input type='radio' name='radio" + count + "' value='1' required/> OPTION A </td> <td> <input type='text' name='option_a" + count + "' required autocomplete='off'/> </td> </tr>";
	x +=  "<tr> <td class = 'left-col'> <input type='radio' name='radio" + count + "' value='2'> OPTION B </td> <td> <input type='text' name='option_b" + count + "' required autocomplete='off'/> </td> </tr>";
	x +=  "<tr> <td class = 'left-col'> <input type='radio' name='radio" + count + "' value='3'> OPTION C </td> <td> <input type='text' name='option_c" + count + "' required autocomplete='off'/> </td> </tr>";
	x +=  "<tr> <td class = 'left-col'> <input type='radio' name='radio" + count + "' value='4'> OPTION D </td> <td> <input type='text' name='option_d" + count + "' required autocomplete='off'/> </td> </tr>";
	x +=  "<tr> <td class = 'left-col'>Enter the score </td> <td> <input type='number' name='score_" + count + "' required autocomplete='off' min = '1' max = '100'/> </td> </tr>";
	x +=  "</table>";
	var y = "<p id='qn" + count + "'> </p>";
	document.getElementById('questions').insertAdjacentHTML("beforeend", y);
	document.getElementById("qn"+count).innerHTML = x;
	document.getElementById('num_of_qns').value = count;
}

</script>
</html>
