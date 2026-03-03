<?php 

require 'config.php';
if(isset($_POST['login'])){
	extract($_POST);
	$password=password_hash($password, PASSWORD_DEFAULT);
	$insert=$conn->query("INSERT INTO admin(username,password) VALUES('$username','$password')");
	

	if($insert){
		echo "<p>Inserted</p>";
		echo "<script>

setTimeout(function(){
	window.location='admin_login.php'
	},5000);
		</script>";
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