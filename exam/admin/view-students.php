<?php 
require 'config.php';

$select= $conn->query("SELECT * FROM students");

?>
<style>
	table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
.subject{
    text-transform: uppercase;
}
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: crimson;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
img{
    width: 100px;
    height: 100px;
}.search-input{
	margin: 30px;
	padding: 5px;
}.action{
	display: flex;
	gap:10px;
}a{
	padding: 5px;
	text-decoration: none;
}a.edit{
	background-color: green;
	color: white;
	text-align: center;
}a.delete{
	background-color: red;
	color: white;
}.refresh{
	display: inline-block;
	float: right;
	margin-top: 20px;
}a.result{
	background-color: crimson;
	color: white;
}
</style>
<hr>
    <table id="mytable">
    	<tr><input type="text" name="search-input" class="search-input" placeholder="Enter Student Name">
    		<a href="dashboard.php?url=view-students" class="refresh">Refresh</a></tr>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Class</th>
                   <th>Address</th>
                   <th>Email</th>
                   <th>Image</th>
                <th>Action</th>
               
             
            </tr>
        
        </thead>
        <hr>
        <tbody>
<?php 
while($row=$select->fetch_assoc()){

?>
<tr>
	<td><?php echo $row['id'];?></td>
	<td><?php echo $row['name'];?></td>
	<td><?php echo $row['class'];?></td>
	<td><?php echo $row['address'];?></td>
	<td><?php echo $row['email'];?></td>
	<td><img src="<?php echo $row['image'];?>" alt=""></td>
	<td class="action"><a class="edit" href="dashboard.php?url=edit&id=<?php echo $row['id'];?>">Edit</a>
		
		<a class="delete" href="dashboard.php?url=delete&id=<?php echo $row['id'];?>">Delete</a></td>
</tr>
<?php 

}
?>
        </tbody>
    </table>
        	<script src="../jquery.min.js"></script>
        	<script>
        		$(".search-input").on("input", function() {
  var searchQuery = $(this).val().toLowerCase();
        			$.ajax({
        		url:'fetch_student.php',
        				type:'POST',
        				data:'search='+searchQuery,

        					success:function(response){
        						var tableBody = $('#mytable tbody');
 tableBody.empty();

response= JSON.parse(response);
     
      var row = '<tr>' +
                '<td>' + response.id + '</td>' +
                  '<td>' + response.name + '</td>' +
                    '<td>' + response.class + '</td>' +
                       '<td>' + response.address + '</td>' +
                          '<td>' + response.email + '</td>' +
                '<td><img src="' + response.image + '" width="50" height="50"></td>' +
         '<td class="action"><a class="edit" href="dashboard.php?url=edit&name='+response.name+'">Edit</a><a class="result" href="dashboard.php?url=get_student_result&name='+response.name+'">Result</a><a href="dashboard.php?url=edit&name='+response.name+'" class="delete">Delete</a></td>' +
                '</tr>';
      tableBody.append(row);

  




        					}
        	});
        		});
        	</script>



        			

 
        	