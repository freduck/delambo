<?php 

require "config.php";
extract($_POST);
if(empty ($question)){
    exit();
}
$check=$conn->query("SELECT * FROM exam WHERE question='$question' AND subject='$subject'");
if(!$check->num_rows>0){
$insert=$conn->query("INSERT INTO exam (subject,question,option_1,option_2,option_3,option_4,answer) VALUES('$subject','$question','$option_1','$option_2','$option_3','$option_4','$answer')");
if($insert){
    echo "inserted";
    die();
}
}else{

}
?>