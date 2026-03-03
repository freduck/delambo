

<?php 
require "exam-header.php";
require 'admin/config.php';
// require 'submit.php';
// session_start();
?>

<?php
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

$query = "SELECT * FROM exam WHERE subject =9 LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$total_query = "SELECT COUNT(*) AS total_questions FROM exam WHERE subject =9";
$total_result = $conn->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_rows = $total_row['total_questions'];
$total_pages = ceil($total_rows / $limit);
// $qid_get=$result->fetch_assoc();
// $q_id=$qid_get['id'];
// $anwer_questions=$conn->query("SELECT COUNT(*) AS answered_questions FROM user_responses WHERE subject_id=3 AND user_id='$user_id'");
// // Display questions

echo "<br><hr><br><div class='question'>
<p id='response' class='response-1'></p>
<p id='response-2' class='response-2'></p>
<form action='submit.php' method='post'>";
$c=0;
while ($row = $result->fetch_assoc()) {
     
  echo "<p><b>Question: </b>".$page.'</b><br/><br/>';
  echo "<p id='q'>". $row['question'] . "</p><br/>";
  echo "<ul>";
  echo "<li><input type='radio' name='answer' value='".$row['option_1']."' id='answer'> A. " . $row['option_1'] . "</li>";
  echo "<li><input type='radio' name='answer' value='".$row['option_2']."' id='answer'> B. " . $row['option_2'] . "</li>";
  echo "<li><input type='radio' name='answer' value='".$row['option_3']."' id='answer'> C. " . $row['option_3'] . "</li>";
  echo "<li><input type='radio' name='answer' value='".$row['option_4']."' id='answer'> D. " . $row['option_4'] . "</li>";
  echo "</ul>";
  
  echo "<input type='hidden' name='question_id' value='".$row['id']."' id='question_id'>";
   echo "<input type='hidden' name='subject_id' value='".$row['subject']."' id='subject_id'>";
     echo "<input type='hidden' name='subject' value='digital' id='subject'>";
  
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

    <a href="?page=<?php echo $i;?>" id='page' data-id="<?php echo $i;?>"><?php echo $i;?></a>
    <?php
  }
}
if ($page < ceil($total_rows / $limit)) {?>

  <a href="?page=<?php echo ($page + 1);?>">Next</a>
  <?php
}?>
</div>
<p><a href="result.php?subject=9">End Exam</a></p>
</div>
<br>
<hr><br>
<h3 id='answered'>Answered Questions</h3>
<ul class='answered-question'>

    <?php
$select=$conn->query("SELECT * FROM confirm_answer WHERE student_id='$user_id'");
if($select->num_rows>0){
    
while($r=$select->fetch_assoc()){
    
    echo "<li>No: ".$r['question_no']."</li>";
    
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
.pagination a:visited{
  background-color:red;
  /* color:white; */
  color:red;
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
}#response{
    display:none;
    border:1px solid whitesmoke;
    padding:30px;
    text-align:center;
    background-color:lightgreen;
    color:white;
}
#response-2{
    display:none;
    border:1px solid whitesmoke;
    padding:30px;
    text-align:center;
    background-color:red;
    color:white;
}
a:visited{
    background-color: red;
}
</style>
<script src='jquery.min.js'></script>
<script>
    
let p=document.querySelectorAll('#page');
p.forEach(e=>{
    e.addEventListener('click',function(){
$.ajax({
url:'confirm.php',
type:'POST',
data:'confirm='+$(this).text(),
success:function(e){
    console.log(e)
},
error:function(err){
    console.log(err);
}
});
});
});
let confirm=document.querySelector('#confirm');
let answer=document.querySelector('#answer').value;
let user_id="<?php echo $user_id;?>";
let subject=document.querySelector('#subject').value;
let subject_id=document.querySelector('#subject_id').value;
let question_id=document.querySelector('#question_id').value;
confirm.addEventListener('click', function(){
$.ajax({
  url:'submit',
  type:'POST',
  data:'answer='+answer+'&user_id='+user_id+'&subject_id='+subject_id+'&question_id='+question_id,
  error:function(err){
    console.log(err);
  },
  success:function(resp){
    console.log(resp);
    if(resp==1){
        $('#response').text('Question Answered Successfully Please Enter The Next Question');
        $('#response').show('fast');
     window.onload=function(){
        document.querySelector('#response').scrollIntoView({
            behavior:'smooth'
        })
    }
    //    document.querySelector('.response').classList.add('response-1');
    }else if(resp==2){
          $('#response-2').text('Question Has been Answered! Before, But Has Now Been Updated');
        //   document.querySelector('.response-1').classList.toggle('response-2');
        $('#response-2').show('fast');
       window.onload=function(){
        document.querySelector('#response-2').scrollIntoView({
            behavior:'smooth'
        })
    }
        // document.querySelector('#response-2').classList.add('response-2');
    }
    setTimeout(function(){

        $('#response').hide();
         $('#response-2').hide();
    },3000);
  }
})
});

</script>