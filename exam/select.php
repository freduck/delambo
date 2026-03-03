
<?php 
if(isset($_POST['subject'])){
    extract($_POST);
    header("location:".$subject.'.php');
}


?>

<form  action='' method="post">
<input list="subject" name="subject" placeholder="Select The Subject You Want To Write">
    <datalist id="subject" id="">
<option value="">Choose Subject</option>
<?php 
require "admin/config.php";

$sel=$conn->query("SELECT * FROM subject");
while($sub=$sel->fetch_assoc()){
    ?>


    <option>
        <?php echo $sub['subject_name'];?>
    </option>
 <?php   
    
}
    ?>



?>
</datalist>
<p>
<button type='submit'>Start</button>
</p>
</form>

<style>
    form{
        padding:50px;
        width:700px;
        margin:0 auto;
        border:1px solid whitesmoke;
        box-shadow:rgba(0,0,0,.012) 2px 2px 2px 2px;
        margin-top:20%;

    }
    form input[list]{
        padding:10px;
        width:100%;
        text-transform:uppercase;
    }
    datalist{
        text-transform:uppercase;
    }
    button{
        padding:10px;
        color:red;
        color:white;
        border:1px solid whitesmoke;
        

    }
</style>