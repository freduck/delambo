<?php 

require 'config.php';
extract($_POST);
$check=$conn->query("SELECT * FROM result WHERE student_name='$name' AND subject='$subject' AND term='$term'");
if($check->num_rows>0){
	echo 0;
	die();
}
$insert=$conn->query("INSERT INTO result(student_name,subject,test_1,test_2,ca_total,exam,total_score,grade) VALUES('$name','$subject','$term','$test_1','$test_2','$ca_total','$exam','$total_score','$grade')");
if($insert){
	echo 1;
}
// var_dump($_POST);
?>