<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DE-LAMBO EXAM</title>
    <link rel="stylesheet" href="css/top.css">
    <style>
        .navbar{
display:flex;
        }
        .right{
            width: 400px;
            float:right;
            margin-right:50px;
            display: flex;
            flex-direction: row;
        }
    </style>
</head>
<nav class="navbar navbar-expand">
    <?php 
  require "admin/config.php";
  $na=$conn->query("SELECT * FROM settings");
  if($na->num_rows>0){
    $row=$na->fetch_assoc();
    ?>
       <h4 style="margin-right:50px;"><?php echo $row['school_name'];?></h4>
    <?php
  }else{
    echo "School Application";
  }
    ?>

    <div>

        <a href="index.php" class="nav-item">Home</a>
        <a href="login.php" class="nav-item">Login</a>
            <a href="about.php" class="nav-item">About Us</a>
         
    </div>
    <?php 
    session_start();
  
   
if(isset($_SESSION['username'])){
    
    
    ?>

<div class='right'>

    <div class='drop-down-inner'>
        <h3><?php echo $_SESSION['username'];?></h4>
                     <li><a href="logout">Logout</a></li>   
        
    </div>
    <br>
   
</div>


</div>





<?php 
}else{
    header('location:student_login');
}
?>



</nav>
 <?php require 'timer.php';?>