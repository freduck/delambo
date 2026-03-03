<?php
// Configuration
require "admin/config.php";
session_start();
if(isset($_POST['answer'])){
    //  var_dump($_POST);
 $user_id=$_SESSION['user_id'];
extract($_POST);
// echo $answer;
                 $check=$conn->query("SELECT * FROM user_responses WHERE user_id='$user_id' AND question_id='$question_id'");
                 if($check->num_rows>0){
                 $update= $conn->query("UPDATE user_responses SET user_answer ='$answer' WHERE question_id='$question_id' AND user_id='$user_id'");
      
                 if($update){
                  header('location:'.$subject);
                  // exit();
                 }
                 }else{
         $query = "INSERT INTO user_responses (question_id,subject_id ,user_id,user_answer) VALUES ('$question_id','$subject_id','$user_id','$answer')";
           $query2 = $conn->query("INSERT INTO answered_questions (q_id,student_id,subject_id) VALUES ('$question_id','$user_id','$subject_id')");
       
       
         if($conn->query($query)){
           header('location:'.$subject);
        // echo 1;
       }
    }
  }
  // var_dump($_POST);
  echo $conn->error;
// if (isset($_POST['answer'])) {
//     $answers = $_POST['answers'];
//     foreach ($answers as $question_id => $answer) {
//         // Process the answer here
//         $query = "INSERT INTO user_responses (question_id,user_id, user_answer) VALUES ('$question_id','$user_id','$answer')";
//         $conn->query($query);

//     }


// Close connection
// $conn->close();

// Redirect to next page or display result
// header('Location: result.php');
?>