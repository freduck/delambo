<?php 
require "admin/config.php";
session_start();
$user_id=$_SESSION['user_id'];
if(isset($_POST['confirm'])){
    extract($_POST);
    $check=$conn->query("SELECT * FROM confirm_answer WHERE question_no='$confirm' AND student_id='$user_id'");
    if($check->num_rows>0){
        // $conn->query("UPDATE confirm_answer SET  question_no= '$confirm' AND student_id='$user_id'");
        exit();
    }else{

        $i= $conn->query("INSERT INTO confirm_answer (question_no,student_id)VALUES('$confirm','$user_id')");
        if($i){
         echo 1;
        }
    }
}
