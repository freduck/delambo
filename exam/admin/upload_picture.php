<?php 
require 'config.php';

if(isset($_POST['submit'])){
	extract($_POST);
	$image=$_FILES['passport']['name'];
	$tmp_name=$_FILES['passport']['tmp_name'];
	$folder='passports/'.$image;
	$update=$conn->query("UPDATE  students SET image='$folder' WHERE name='$name'");
	if($update){
		move_uploaded_file($tmp_name, $folder);
		echo "Done";
	}
}