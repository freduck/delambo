
       <?php 

require 'admin/config.php';
if(isset($_POST['add_student'])){
    extract($_POST);
    $check=$conn->query("SELECT * FROM users WHERE username='$username'");
    if($check->num_rows>0){
        echo "<div class='alert-danger show'>Student Registered</div>";
        exit();
    }
    $insert=$conn->query("INSERT INTO users (name,username,email,address,password) VALUES('$name','$username','$email','$address','$password')");
    if($insert){
        echo "<div class='alert-sucess show'>Student Registered</div>";
    }
}

?>
<style>
    .alert-success {
  background-color: #d4edda;
  border-color: #c3e6cb;
  color: #155724;
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 10px;
}

/* Alert Danger */
.alert-danger {
  background-color: #f8d7da;
  border-color: #f5c6cb;
  color: #721c24;
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 10px;
}
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
    
}textarea{
    width:100%;
    padding:10px;
    outline:none;
    border:1px solid whitesmoke;
     box-shadow:rgba(0, 0, 0, 0.07)1px 1px 1px 1px;
}
</style>
    <?php include"header.php";?>
    <div class="login-container">
 
<h3>Student Login</h3>
        <form action='' method='post'>
            <div class="form-group">
                <input type="text" name="name" id="" placeholder='Enter Name' required>
            </div>
            <div class="form-group">
                <input type="text" name="username" id="" placeholder='Enter Username' required>
            </div>
             <div class="form-group">
                <input type="email" name="email" id="" placeholder='Enter Email' required>
            </div>
             <div class="form-group">
                <textarea type="text" name="address" id="" placeholder='Enter Address' required></textarea>
            </div>
             <div class="form-group">
                <input type="password" name="password" id="" placeholder='Enter Password' required>
            </div>

            <div class="form-group">
                <button type="submit" name="add_student">Login</button>
            </div>
        </form>
    </div>
</body>
</html>