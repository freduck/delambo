<?php 
require 'config.php';

if(isset($_POST['submit'])){
	extract($_POST);
	$image=$_FILES['image']['name'];
	$tmp_name=$_FILES['image']['tmp_name'];
	$folder='second_term/'.$image;
	$update=$conn->query("UPDATE  second_term SET image='$folder' WHERE student_name='$student_name'");
	if($update){
		move_uploaded_file($tmp_name, $folder);
		echo "Done";
	}
}