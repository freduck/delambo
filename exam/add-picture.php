
    <form action="get_student_result.php" method="post" enctype="multipart/form-data">
        <select name="name" class="name" >
            
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
        </select>
      <br><input type="file" name="passport" id="">
        <button type="submit" name="submit">Submit</button>
    </form>
