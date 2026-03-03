<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DE-LAMBO EXAM</title>
    <link rel="stylesheet" href="../css/top.css">

</head>
<nav class="navbar navbar-expand">
    <a href="dashboard.php?url=view-students" class="nav-item">Home</a>
    <a href="login.php" class="nav-item">Login</a>
        <a href="about.php" class="nav-item">About Us</a>
    <?php 
    session_start();
    require "config.php"; 
    $select=$conn->query("SELECT * FROM settings");
    if($select->num_rows>0){
        $data=$select->fetch_assoc();
    }
if(isset($_SESSION['admin_username'])){


$username= $_SESSION['admin_username'];
    ?>

<?php 
}else{
    header('location:admin_login.php');
}
?>
<div style="text-align:right;">
    
<?php echo $data['school_name'];?>
</div>
</nav>