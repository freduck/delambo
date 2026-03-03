<?php 

require 'admin/config.php';
extract($_POST);
$q=$conn->query("SELECT * FROM students WHERE name='$name'");
if($q->num_rows>0){
	$data=[];
	while($row=$q->fetch_assoc()){
$data=$row;

	}
echo	json_encode($data);

}