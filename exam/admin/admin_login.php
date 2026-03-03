<?php 

require 'config.php';
if(isset($_POST['login'])){
	extract($_POST);
	$get=$conn->query("SELECT * FROM admin WHERE username = '$username'");
	if($get->num_rows>0){
		$row=$get->fetch_assoc();
	if(password_verify($password, $row['password'])){
		session_start();
		$_SESSION['admin_username']=$row['username'];
		header('location:dashboard.php');
	}else{
		echo "<h2>Login Failed Try Again</h2>";
	}
}
}
?>
<style>
	h2{
		text-align: center;
	}
	.login-panel{
		width: 500px;
		margin: 0 auto;
		border: 1px solid whitesmoke;
		padding: 30px;
		margin-top: 20%;
	}.space{
		margin: 5px;
		padding: 10px;
	}input{
		padding: 3px;
		width: 100%;
	}button[type='submit']{
		padding: 8px;
		width: 100%;
	}h4{
		text-align: center;
	}
</style>
<div class="login-panel">
	<h4>Admin Login</h4>
	<form action="" method="post">
		<div class="space">
			<input type="text" name="username" id="" placeholder="Enter Username" required>
		</div>
		<div class="space">
			<input type="password" name="password" id="" required placeholder="Enter Password">
		</div>
		<div class="space">
			<button type="submit" name="login">Login</button>
		</div>
	</form>
</div>