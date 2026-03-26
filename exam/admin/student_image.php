
<?php 

require "config.php";

$select = $conn->query("SELECT * FROM students");

?>
<div class="container">
	<div class="form">
		<form action="update_picture.php" method="post" enctype="multipart/form-data">
			<div class="space">
				<select name="student_name" id=""required>
					<option value="">Select Student</option>
					<?php 

while($row=$select->fetch_assoc()){
	?>

<option value="<?php echo $row['name'];?>">
	<?php echo $row['name'];?>
</option>

	<?php
}

					?>
				</select>
			</div>
			<div class="space">
				<input type="file" name="image" id="" required>
			</div>
			<div class="space">
				<button type="submit" name="submit">Update</button>
			</div>
		</form>



		<style>
			.container{
				width:600px;
				margin:  0 auto;
				border: 1px solid whitesmoke;
			}
		</style>
	</div>
</div>