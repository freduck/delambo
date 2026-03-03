<?php 

require 'config.php';
if(isset($_POST['search'])){
	extract($_POST);
$select=$conn->query("SELECT * FROM students WHERE name LIKE '%$search%' LIMIT 1");
if($select->num_rows>0){

$data=[];
while($fetch=$select->fetch_assoc()){
	$data=$fetch;
}
echo json_encode($data);
}else{
	$data='No Record Found';
	echo json_decode($data);
}
}
?>