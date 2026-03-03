
    <form action="upload_comment.php" method="post">
       <input list="name" name="name">
<datalist id="name">
            
            <option value="">Select Student</option>
            <?php 
            require 'config.php';
            $select_2=$conn->query("SELECT * FROM students");
while($row=$select_2->fetch_assoc()){


            ?>
<option><?php echo $row['name'];?></option>

            <?php 
}

            ?>
        </datalist>
      <div>
          <textarea name="teacher_comment" id="" cols="40" rows="2" placeholder="Teacher's Comment"></textarea>
      </div>
      <div>
          <textarea name="principal_comment" id="" cols="40" rows="2" placeholder="Pincipal's Comment"></textarea>
      </div>
        <button type="submit" name="submit">Submit</button>
    </form>
    <style>
        form{
            padding: 10px;
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
            width: 100%;
        } div{
            margin-top: 5px;
        }
    </style>
