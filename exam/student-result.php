<?php require "header.php";?>
    <form action="get_student_result.php" method="post">
        <label for="">Search Student</label><br><br>
       <input list="name" name="name" style="padding:5px; width:400px;" placeholder="Search Student Result By Name">
<datalist id="name">
            
            <option value="">Select Student</option>
            <?php 
            require 'admin/config.php';
            $select_2=$conn->query("SELECT * FROM students");
while($row=$select_2->fetch_assoc()){


            ?>
<option><?php echo $row['name'];?></option>

            <?php 
}

            ?>
        </datalist>

      
      
        <button type="submit" name="submit">Submit</button>
    </form>
    <style>
        button{
            padding:6px;
            background-color:crimson;
            color:white;
            border:1px solid whitesmoke;
            color:white;
        }label {
            padding:10px;
            margin:10px;
            margin-bottom:20px;
        }
        form{
            padding: 30px;
            width: 500px;
            border: 1px solid whitesmoke;
            margin: 0 auto;
            margin-top: 10%;

        }
        iput[list]{
            padding: 6px;
            width: 100%;
        }
        datalist{
            padding:10px;
            width: 100%;
        }#term{
          padding: 10px;
        }
    </style>
