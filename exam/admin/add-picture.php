
    <form action="upload_picture.php" method="post" enctype="multipart/form-data">
        <select name="name" class="name" >
            
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
        </select>
      <br><input type="file" name="passport" id="">
        <button type="submit" name="submit">Submit</button>
    </form>
