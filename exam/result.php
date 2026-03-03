<?php
require "admin/config.php";
// session_start();
require "exam-header.php";
?>
<div class="result">

<?php
$username=$_SESSION['name'];
$user_id = $_SESSION['user_id'];
$subject = $_GET['subject'];
$delete=$conn->query("DELETE FROM confirm_answer WHERE student_id='$user_id'");
if($subject==1){
    $subject_n='Mathematics';
}
if($subject==5){
    $subject_n='C.R.K';
}
if($subject==7){
    $subject_n='Business Studies';
}
if($subject==10){
    $subject_n='Literature-In English';
}

if($subject==4){
    $subject_n='Home Economics';
}
if($subject==2){
    $subject_n='English Language';
}
if($subject==6){
    $subject_n='Intermediate Science';
}
if($subject==9){
    $subject_n='Digital Technology';
}
if($subject==15){
    $subject_n='P.H.E';
}
if($subject==11){
    $subject_n='History';
}


$stmt = $conn->prepare("
  SELECT q.question, ur.user_answer, q.answer
  FROM exam q
  JOIN user_responses ur ON q.id = ur.question_id
  WHERE ur.user_id = ? AND q.subject = ?
");
$stmt->bind_param("is", $user_id, $subject);
$stmt->execute();
$result = $stmt->get_result();

echo "<p><h2>Name:      </h2>$username</p><br/><p><h2>Subject:</h2>$subject_n<br/></p><hr/>";

while ($row = $result->fetch_assoc()) {
  echo "<p id='q'>Question: " . $row['question'] . "</p><hr/>";
  echo "<p id='a'>Your Answer: " . $row['user_answer'] . "</p><hr/>";
  echo "<p id='c'>Correct Answer: " . $row['answer'] . "</p><hr/>";
  if ($row['user_answer'] == $row['answer']) {
    echo "<div class='success-message'>
  <span class='checkmark'></span>
  <p>Your answer was correct!</p>
</div><hr/>";
  } else {
    echo "<div class='error-message'>
 <span class='crossmark'></span>  <b>Your Answer Was Wrong </b>
</div>";
  }
}

$stmt = $conn->prepare("
  SELECT COUNT(*) AS total_questions, SUM(CASE WHEN ur.user_answer = q.answer THEN 1 ELSE 0 END) AS correct_answers
  FROM exam q
  JOIN user_responses ur ON q.id = ur.question_id
  WHERE ur.user_id = ? AND q.subject = ?
");
$stmt->bind_param("is", $user_id, $subject);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$total_questions = $row['total_questions'];
$correct_answers = $row['correct_answers'];
$score = ($total_questions > 0) ? ($correct_answers / $total_questions) * 100 : 0;
$score_1=round($score,1);
echo "<hr/><h3 id='ur'>Your Score: $score_1%</h3><hr/>";
if($score>=50){
    echo "<p id='pass'>Congratulations! You Passed the subject</p><hr/>";
}else{
     echo "<p id='f'>Opps! You did'nt Passed  the subject</p><hr/>";
}
echo "Correct Answers: $correct_answers/$total_questions";
?>
<p><button id='print'>Print</button></p>
</div>

<style>
    .result{
        padding:50px;
        width:700px;
        border:1px solid whitesmoke;
        margin: 0 auto;
    }
    p{
        padding:10px;
    }
    #cr{
        background-color:lightgreen;
        padding:10px;
        margin:30px;
        margint-top:20px;
        color: white;
        
    }
    .crossmark {
  display: inline-block;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background-color: #F44336;
  position: relative;
}

.crossmark::before, .crossmark::after {
  content: "";
  position: absolute;
  width: 2px;
  height: 14px;
  background-color: white;
  top: 3px;
  left: 9px;
}

.crossmark::before {
  transform: rotate(45deg);
}

.crossmark::after {
  transform: rotate(-45deg);
}
  .error-message {
  display: flex;
  flex-direction:row;
  align-items: center;
  color: #F44336;
}

.error-message .crossmark {
  margin-right: 10px;
}.checkmark {
  display: inline-block;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background-color: #4CAF50;
  position: relative;
  padding: 5px;
}

.checkmark::after {
  content: "";
  position: absolute;
  left: 10px;
  top: 4px;
  width: 6px;
  height: 12px;
  border: solid white;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}
  .success-message {
  display: flex;
  align-items: center;
  color: #4CAF50;
  flex-direction:row;
}

.success-message .checkmark {
  margin-right: 10px;
}

    #in{
         background-color:red;
        padding:10px;
        margin:30px;
        margint-top:20px;
        color: white;
    }#print{
      padding:10px;
    }
    @media print{
      #print{
        display:none;
      }
      #timer{
        display:none;
      }
      .navbar{
        display:none;
      }
      hr{
        display:none;
      }
    }
</style>

<script>
  const print= document.querySelector('#print');
  const printfunction=function(){
    window.print();
  }
  print.addEventListener('click',printfunction);
</script>