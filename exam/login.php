<?php 
session_start();
require 'admin/config.php';
if(isset($_POST['login'])){
extract($_POST);
$select=$conn->query("SELECT* FROM students WHERE username='$username' AND password='$password'");
if($select->num_rows>0){
    $row=$select->fetch_assoc();
$_SESSION['username']=$username;
$_SESSION['name']=$row['name'];
$_SESSION['user_id']=$row['id'];
echo $row['id'];
header('location:select.php');
}else{

}

}

?>
<style>
    .login-container{
    padding:10px;
    width: 600px;
    margin: 0 auto;
    border:1px solid whitesmoke;
    margin-top:30px;
    box-shadow:rgba(0, 0, 0, 0.18)2px 2px 10px 2px;
} 
form {padding:10px;}
div.form-group{
    padding:10px;
    width: 100%;
}
div.form-group input{
padding:8px;
width:100%;
  box-shadow:rgba(0, 0, 0, 0.07)1px 1px 1px 1px;
  border:1px solid whitesmoke;
  outline:none;
  border-radius:50px;
}
h3{
    text-align:center;
    padding:10px;
    text-transform:uppercase;
    color:crimson;
}button{
    padding:10px;
    width:100%;
    color:white;
    background-color:crimson;
    border:1px solid whitesmoke;
    border-radius:50px;
    
}
</style>

    <div class="login-container">
<h3>Student Login</h3>
        <form action='' method='post'>
            <div class="form-group">
                <input type="text" name="username" id="" placeholder='Enter Username' required>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="" placeholder='Enter Username' required>
            </div>
            <div class="form-group">
                <button type="submit" name="login">Login</button>
            </div>
        </form>
    </div>
</body>
</html>