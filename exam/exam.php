<?php 
require "exam-header.php";
require 'admin/config.php';
require 'submit.php';
// session_start();
// if(!isset($_SESSION['user_id'])){
//   header('location:login.php');
// }
$user_id=$_SESSION['user_id'];
$limit = 1; // questions per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total questions
$query = "SELECT COUNT(*) AS total_questions FROM exam";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$totalQuestions = $row['total_questions'];

// Get questions for current page
$query = "SELECT * FROM exam  LIMIT $limit OFFSET $offset";
$result = $conn->query($query);
$count=1;
// Display questions
echo "<div class='question'><form action='' method='post'>";
while ($row = $result->fetch_assoc()) {
  echo "<p><b>Question: </b>".$row['id'].'</b><br/>';
  echo "<p id='q'>". $row['question'] . "</p>";
  echo "<ul>";
  echo "<li><input type='radio' name='answer' value='".$row['option_1']."'> A. " . $row['option_1'] . "</li>";
  echo "<li><input type='radio' name='answer' value='".$row['option_2']."'> B. " . $row['option_2'] . "</li>";
  echo "<li><input type='radio' name='answer' value='".$row['option_3']."'> C. " . $row['option_3'] . "</li>";
  echo "<li><input type='radio' name='answer' value='".$row['answer']."'> D. " . $row['answer'] . "</li>";
  echo "</ul>";
  $count+=1;
  echo "<input type='hidden' name='question_id' value='".$row['id']."'>";
}
echo "<input type='submit' value='Answer This Question' name='submit'>";
echo "</form>";
?>
<div class="pagination">
  <?php
if ($page > 1) {?>



  <a href="?page=<?php echo ($page - 1); ?>">Previous</a> 
  <?php
}
for ($i = 1; $i <= ceil($totalQuestions/ $limit); $i++) {
  if ($i == $page) {?>


    <span><?php echo $i ;?></span> 
    <?php
  } else {?>

    <a href="?page=<?php echo $i;?>"><?php echo $i;?></a>
    <?php
  }
}
if ($page < ceil($totalQuestions / $limit)) {?>

  <a href="?page=<?php echo ($page + 1);?>">Next</a>
  <?php
}?>
</div>
</div>






<style>
  #q
b{
  padding:10px;
  margin:20px;

}
.question{
  padding:30px;
  width:1000px;
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

.pagination span {
  background-color: #337ab7;
  color: #fff;
}
input[type="submit"]{
  padding:10px;
  margin:6px 0 0 0;
}
form{
  width:400px;
  margin:0 auto;
  margin-top:20px;
}
</style>

