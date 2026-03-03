<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DE-LAMBO EXAM</title>
    <link rel="stylesheet" href="css/top.css">
</head>
<nav class="navbar navbar-expand">
    <a href="index.php" class="nav-item">Home</a>

        <a href="about.php" class="nav-item">About Us</a>
    
<div class='right'>
<?php 
require "admin/config.php";
$setting=$conn->query("SELECT * FROM settings");
if($setting->num_rows>0){
    $system=$setting->fetch_assoc();
    echo $system['school_name'];
}else{
    echo "<h1>School Application</h1>";
}


?>
    
</div>


</div>








</nav>