
<?php 

require "config.php";

$select = $conn->query("SELECT * FROM second_term");

?>
<div class="container">
	<div class="form">
		<form action="upload_picture.php" method="post" enctype="multipart/form-data">
			<div class="space">
				<select name="student_name" id=""required>
					<option value="">Select Student</option>
					<?php 

while($row=$select->fetch_assoc()){
	?>

<option value="<?php echo $row['subject_name'];?>"></option>

	<?php
}

					?>
				</select>
			</div>
			<div class="space">
				<input type="file" name="image" id="" required>
			</div>
			<div class="space">
				<button type="submit">Update</button>
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