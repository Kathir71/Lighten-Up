<?php
$questions_array = $_SESSION['questions_array'];
$names_array = $_SESSION['names_array'];
$number_of_questions = $_SESSION['number_of_questions'];
?>
<!DOCTYPE html>
<html>

<body>
    <script>
        const questionsArray = <?php echo json_encode($questions_array); ?>; //converting a php array to a js array
        const numberOfQuestions = parseInt(<?php echo $number_of_questions ?>);
        var clickCount = 0;
        let question = document.querySelector('#question');
        let optionLabels = document.querySelectorAll('label');
        let options = document.querySelectorAll('input[type = "radio"]');
        let label = document.querySelectorAll('.option');
        let score = document.getElementById('score');
        let ansArr = [];
        let nextBtn = document.getElementById('next-btn');
        window.onload = (update_questions());
        //updating the questions and options
        function update_questions() {
            let selected = 0;
            if (clickCount < numberOfQuestions) {
                question.textContent = questionsArray[clickCount].q;
                optionLabels[0].textContent = questionsArray[clickCount].a;
                optionLabels[1].textContent = questionsArray[clickCount].b;
                optionLabels[2].textContent = questionsArray[clickCount].c;
                optionLabels[3].textContent = questionsArray[clickCount].d;
                score.innerHTML = questionsArray[clickCount].sc + ' marks';
            }
            for (let i = 0; i < 4; i++) {
                     label[i].className = 'option';
                if (options[i].checked) {
                    ansArr.push(options[i].value);
                    options[i].checked = false;
                    selected = 1;
                }
            }
            if (selected == 0 && clickCount != 0) {
                ansArr.push("0");
            }
            clickCount++;
            if (clickCount === numberOfQuestions + 1) {
                let important = document.querySelector('#important');
                var ansString = ansArr.join("");
                important.value = ansString;
            }
            console.log(ansArr);
        }

        //the timer section
        window.onload = (clock());
        var flag = 0;
        var qns = 1;
        document.getElementById("qn_no").innerHTML = "1 out of " + numberOfQuestions + " Questions";
        document.getElementById("auto_next").style.visibility = "hidden";
        document.getElementById("submit").style.visibility = "hidden";

        function clock() {
            var seconds = document.getElementById("countdown").innerHTML = 30;
            if (numberOfQuestions == 1) {
                document.getElementById("next-btn").innerHTML = "Submit";
            }
            var countdown = setInterval(function() {
                seconds--;
                document.getElementById("countdown").innerHTML = seconds;
				if((seconds <= 30) && (seconds > 15))
				{
					document.getElementById("countdown").style.backgroundColor = "#5DD206";
				}
				else if((seconds <= 15) && (seconds > 5))
				{
					document.getElementById("countdown").style.backgroundColor = "#C8F740";
				}
				else if(seconds <= 5 )
				{
					document.getElementById("countdown").style.backgroundColor = "#F72721";
					document.getElementById("countdown").style.animation = "clockpulse 1s infinite";
				} 
				
                if ((seconds < 0 || flag == 1)) {
					document.getElementById("countdown").style.webkitAnimationPlayState = 'paused';
                    clearInterval(countdown);
                    update_questions();
                    qns++;
                    if (qns <= numberOfQuestions) {
                        document.getElementById("qn_no").innerHTML = qns + " out of " + numberOfQuestions + " Questions";
                        // document.getElementById("qn_no").innerHTML = qns + " / " + numberOfQuestions;
                    }
                    flag = 0;
                    document.getElementById("auto_next").click();
					document.getElementById("countdown").style.backgroundColor = "#5DD206";

                }
            }, 1000);
        }

        function auto_timer() {
            if (qns < numberOfQuestions) {
                clock();
            } else if (qns == numberOfQuestions) {
                document.getElementById("next-btn").innerHTML = "Submit";
                clock();
            } else {
				document.getElementById("submit").click();
                document.getElementById("countdown").innerHTML = "0";		
            }
        }

        function next_timer() {
            flag = 1;
        }
label[0].addEventListener('click' , () => {change_options(0);});
label[1].addEventListener('click' , () => {change_options(1);});
label[2].addEventListener('click' , () => {change_options(2);});
label[3].addEventListener('click' , () => {change_options(3);});
function change_options(i) {
    label[i].className = 'checked';
    for ( let j =0 ; j < 4 ; j++) {
        if( j === i)
        continue;
        label[j].className = 'option';        
    }
}
    </script>
</body>

</html>