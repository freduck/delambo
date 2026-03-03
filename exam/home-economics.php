<?php 
require "exam-header.php";
require 'admin/config.php';
// require 'submit.php';
// session_start();
if(!isset($_SESSION['user_id'])){
  header('location:login.php');
}
$user_id=$_SESSION['user_id'];



// $limit = 1; // questions per page
// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// $offset = ($page - 1) * $limit;

// // Get total questions
// $query = "SELECT * FROM exam  WHERE subject = 'maths' LIMIT $limit OFFSET $offset";
// $result = $conn->query($query);
// $query = "SELECT COUNT(*) AS total_questions FROM exam WHERE subject='maths'";
// $result = $conn->query($query);
// $row = $result->fetch_assoc();
// $totalQuestions = $row['total_questions'];

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 1;
$offset = ($page - 1) * $limit;

// $conn = new mysqli("localhost", "username", "password", "database");

$query = "SELECT * FROM exam WHERE subject =4 LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$total_query = "SELECT COUNT(*) AS total_questions FROM exam WHERE subject =4";
$total_result = $conn->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_rows = $total_row['total_questions'];
$total_pages = ceil($total_rows / $limit);
// $qid_get=$result->fetch_assoc();
// $q_id=$qid_get['id'];
// $anwer_questions=$conn->query("SELECT COUNT(*) AS answered_questions FROM user_responses WHERE subject_id=3 AND user_id='$user_id'");
// // Display questions

echo "<br><hr><br><div class='question'><form action='submit.php' method='post'>";
$c=0;
while ($row = $result->fetch_assoc()) {
     
  echo "<p><b>Question: </b>".$page.'</b><br/>';
  echo "<p id='q'>". $row['question'] . "</p>";
  echo "<ul>";
  echo "<li><input type='radio' name='answer' value='".$row['option_1']."'> A. " . $row['option_1'] . "</li>";
  echo "<li><input type='radio' name='answer' value='".$row['option_2']."'> B. " . $row['option_2'] . "</li>";
  echo "<li><input type='radio' name='answer' value='".$row['option_3']."'> C. " . $row['option_3'] . "</li>";
  echo "<li><input type='radio' name='answer' value='".$row['option_4']."'> D. " . $row['option_4'] . "</li>";
  echo "</ul>";
  
  echo "<input type='hidden' name='question_id' value='".$row['id']."'>";
   echo "<input type='hidden' name='subject_id' value='".$row['subject']."'>";
     echo "<input type='hidden' name='subject' value='math'>";
  
}
echo "<input type='submit' value='Confirm Your Answer' name='submit' id='confirm'>";
echo "</form>";
?>
<div class="pagination">
  <?php
if ($page > 1) {
    
    ?>


  <a href="?page=<?php echo ($page - 1); ?>">Previous</a> 
  <?php
}
for ($i = 1; $i <= ceil($total_rows/ $limit); $i++) {
  if ($i == $page) {?>


    <span><?php echo $i ;?></span> 
    <?php
  } else {?>

    <a href="?page=<?php echo $i;?>"><?php echo $i;?></a>
    <?php
  }
}
if ($page < ceil($total_rows / $limit)) {?>

  <a href="?page=<?php echo ($page + 1);?>">Next</a>
  <?php
}?>
</div>
<p><a href="result.php?subject=1">End Exam</a></p>
</div>
<br>
<hr><br>
<h3 id='answered'>Answered Questions</h3>
<ul class='answered-question'>

    <?php
$select=$conn->query("SELECT * FROM user_responses WHERE user_id='$user_id' AND subject_id=1");
if($select->num_rows>0){
    $i=1;
while($r=$select->fetch_assoc()){
    
    echo "<li>".$i."</li>";
    $i+=1;
}
}else{
    echo "<p class='no'>No Question Has Bean Answered Yet For This Subject</p>";
}
?>

</ul>
<br><hr><br><br>


<style>
  #q
b{
  padding:10px;
  margin:20px;

}
.question{
  padding:30px;
  width:1100px;
  margin:0 auto;
  border:1px solid whitesmoke;
  margin-top:10px;
}
.pagination {
  text-align: center;
  margin-top: 20px;
}

.pagination a, .pagination span {
  padding: 5px 10px;
  border: 1px solid #ccc;
  margin: 0 5px;
  text-decoration: none;
  color: #337ab7;
}

.pagination a:hover {
  background-color: #f2f2f2;
}
.pagination a{
    margin-top:20px;
    display:inline-block;
}
.pagination span {
  background-color: #337ab7;
  color: #fff;
}
input[type="submit"]{
  padding:10px;
  margin:6px 0 0 0;
  background-color:lightgreen;
  color:white;
  border:1px solid whitesmoke;
  border-radius:50px;
  cursor:pointer;
}
form{
  width:500px;
  margin:0 auto;
  margin-top:20px;
}
li{
    list-style-type:none;
    padding:10px;
}.answered-question li{
    float:left;
    border:1px solid whitesmoke;
    padding:10px;
    margin:8px;
    background-color:green;
    color:white;
    border-radius:9px;
}
.answered-question{
    border:1px solid whitesmoke;
    width: 1100px;
    margin:0 auto;
    margin-top:30px;
    margin-bottom:50px;
}#answered{
    padding:10px;
    text-align:center;
}
</style>

<script>
    window.onload=function(){
        document.querySelector('.answered-question').scrollIntoView({
            behavior:'smooth'
        })
    }
</script>