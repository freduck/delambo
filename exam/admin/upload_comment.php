<?php 
require 'config.php';

if(isset ($_POST['name'])){
	extract($_POST);

	$update=$conn->query("UPDATE result SET teacher_comment='$teacher_comment', principal_comment='$principal_comment' WHERE student_name='$name'");
	if($update){
		header('location:dashboard.php?add_comment');
	}

}