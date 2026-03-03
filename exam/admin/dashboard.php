<?php 

require 'header.php';
// session_start();
if(!isset($_SESSION['admin_username'])){
	header('location:admin_login');
}
?>

 <link rel="stylesheet" href="dashboard.css">

<div class="admin-container">
	<div class="left" style="width:170px;">
		
<div class="dropdown">
  <span>&#9776;</span>
    <div class='drop-down-inner'>
        <ul>
            <li><h2><?php echo $username;?></h2></li>
                     <li><a href="dashboard.php?url=view-students">View Student</a></li>
            <li><a href="dashboard.php?url=add-result">Add Student Result</a></li>

            <li><a href="dashboard.php?url=add-comment">Add comment to result</a></li>
            <li><a href="dashboard.php?url=logout">Logout</a></li>
        </ul>
    </div>



</div>
	</div>
	<div class="right">
	<?php 

if(isset($_GET['url'])){
	$url=$_GET['url'];
	require $url.'.php';
}


	?>
	</div>
</div>