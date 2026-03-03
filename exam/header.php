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
    <a href="login.php" class="nav-item">Login</a>
        <a href="about.php" class="nav-item">About Us</a>
    <?php 
    session_start();
    require "admin/config.php";
if(isset($_SESSION['username'])){?>

<div class='right'>
<div class="dropdown">
    <h3>Option</h3>
    <div class='drop-down-inner'>
        <ul>
            <li><h2><?php echo $_SESSION['username'];?></h2></li>
                     <li><a href="edit_profile.php">Take Exam</a></li>
            <li><a href="edit_profile.php">Edit Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>


</div>




<?php 
}
?>



</nav>