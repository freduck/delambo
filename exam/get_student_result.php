
<?php

// session_start();

require "admin/config.php";
$select=$conn->query("SELECT * FROM subject");

$select_2=$conn->query("SELECT * FROM result");
$select_5=$conn->query("SELECT * FROM settings");
$school=$select_5->fetch_assoc();
if(isset($_GET['name'])){
    $name=$_GET['name'];
        $select4=$conn->query("SELECT * FROM result WHERE student_name='$name'");
    $select_3=$conn->query("SELECT students.*,result.* FROM students JOIN result ON students.name=result.student_name WHERE name='$name'");
    $row2=$select_3->fetch_assoc();
    $select_2=$conn->query("SELECT * FROM result WHERE student_name='$name'");
$row3=$select_2->fetch_assoc();
}
if(isset($_POST['submit']) ){
    extract($_POST);
    $name=trim($_POST['name']);
    $select4=$conn->query("SELECT * FROM result WHERE student_name='$name'");
    $select_3=$conn->query("SELECT students.*,result.* FROM students JOIN result ON students.name=result.student_name WHERE name='$name'");
    $row2=$select_3->fetch_assoc();
    $select_2=$conn->query("SELECT * FROM result WHERE student_name='$name'");
$row3=$select_2->fetch_assoc();
    // echo "<img src='admin/".$row2['image']."'>";
}else{
    $name='';
}
if(isset($_POST['name'])){
   extract($_POST);
$sql = "SELECT AVG(total_score) AS average_score, (SUM(total_score) / COUNT(*) * 100) AS percentage_score,SUM(total_score) AS total FROM result WHERE student_name='$name'";

// Execute query
$result = $conn->query($sql);

// Fetch result
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $average_score = $row["average_score"];
    $total=$row['total'];
    // echo $total,$average_score;
    $percentage_score = $row["percentage_score"];
    // echo $percentage_score;
  }
} else {
  echo "No results found";
}
}
if(isset($_GET['name'])){
    $name=$_GET['name'];
$sql = "SELECT AVG(total_score) AS average_score, (SUM(total_score) / COUNT(*) * 100) AS percentage_score,SUM(total_score) AS total FROM result WHERE student_name='$name'";

// Execute query
$result = $conn->query($sql);

// Fetch result
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $average_score = $row["average_score"];
    $total=$row['total'];
    // echo $total,$average_score;
    $percentage_score = $row["percentage_score"];
    // echo $percentage_score;
  }
} else {
  echo "No results found";
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Sheet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            /*padding: 20px;*/
         
        }

        .result-card {
            max-width: 500px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
               font-size:8px;

        }

        h2 {
            text-align: center;
            color: #333;
        }

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
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
img{
    width: 100px;
    height: 100px;
}
        .summary {
            margin-top: 20px;
            font-size: 16px;
        }

        .pass {
            color: green;
            /*font-weight: bold;*/
            font-size: 14px;
        }.student-info{
            display: flex;
            gap: 300px;
            margin-bottom: 20px;
        }.student-info .right{
            float: right;
        }
th{
    font-weight: 800;
}
        .fail {
            color: red;
            font-weight: bold;
        }
        @media print{
            th{
                font-weight: bolder;
            }
            .print{
                display:none;
            }
               .result-card{
                border:none;
                box-shadow:none;
               }
               form{
                display: none;
               }
               .result-card{
                  /* margin-top: 2%; */
               }
               nav{
                display:none;
               }
               hr{
                border:1px solid crimson;
               }
        strong{
        font-size: 12px;
        }
        a{
            display: none;
        }
        }
        .mark,.t-comment,.status,.p-comment,.percentage{
            margin: 5px;
        }th{
            background-color: crimson;
        }.print{

            padding:10px;
            border:1px solid whitesmoke;
            background-color:crimson;color:white;border-radius:8px; marging:10px;
        }
    </style>
</head>
<body>
<?php require 'header.php';

if(!isset($_SESSION['admin_username'])){
    header("location:index.php");
}
?>
    <br><br>
<div class="result-card">
    <hr>
    <h1 style="text-align: center; color: darkred; display: flex;">
        <div><img src='logo.png'  ></div><div style="margin-top:80px; margin-left:50px;"><?php echo $school['school_name'];?></div>
    </h1>
        <div style="text-align:center;color: darkred; margin-left: 50px;"><strong style="text-align:center; color: darkred;">School Address:</strong><?php echo $school['address'];?>
<br>
<div>
   <strong>Tell:</strong> <?php echo $school['phone_number'];?>
</div>
    </div>
    <br>
<hr>
 <h3>Student Result Sheet</h3>
 <div class="student-info">
     <div class="left">
    <p><strong>Name:</strong> <p class="name">
        <?php echo $row2['name'];?>
            
        </p></p>
    <p><strong>Class:</strong>
    
    <p class="class">
        <?php echo $row2['class'];?>
            
        </p> 
    
    
    </p>
    </p>
    <p>
        <strong>
            Adminsion Number:
        </strong>
        <p>
        <?php echo $row2['admision_number'];?>
</p>
    </p>
</div>
<div class="right">
    <img src="admin/<?php echo $row2['image'];?>" alt="">
</div>
 </div>
 
<hr>
    <table>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Subject</th>
                <th>Test 1</th>
                   <th>Test 2</th>
                   <th>C.A Total</th>
                   <th>Exam </th>
                <th>Total Score</th>
                <th>Grade</th>
             
            </tr>
        </thead>
        <tbody>
           <?php 
$i=1;
while($row=$select4->fetch_assoc()){

    ?>
<tr>
     <td> <?php echo $i;?></td>
   <td class="subject"> <?php echo $row['subject'];?></td>
    <td> <?php echo $row['test_1'];?></td>
     <td> <?php echo $row['test_2'];?></td>
      <td> <?php echo $row['ca_total'];?></td>
       <td> <?php echo $row['exam'];?></td>
        <td> <?php echo $row['total_score'];?></td>
         <td> 


            <?php 
if($row['grade']=='A'){

            echo "<span style='background-color:green;padding:10px;color:white; margin:5px;'>".$row['grade']."</span>";
                



}else if($row['grade']=='AB'){
      echo "<span style='background-color:lightgreen;padding:10px;color:white; margin:5px;'>".$row['grade']."</span>";
                
}
else if($row['grade']=='B'){
      echo "<span style='background-color:lime;padding:10px;color:white; margin:5px;'>".$row['grade']."</span>";
                
}
else if($row['grade']=='BC'){
      echo "<span style='background-color:gold;padding:10px;color:white; margin:5px;'>".$row['grade']."</span>";
                
}
else if($row['grade']=='C'){
      echo "<span style='background-color:cream;padding:10px;color:white; margin:5px;'>".$row['grade']."</span>";
                
}
else if($row['grade']=='D'){
      echo "<span style='background-color:darkyellow;padding:10px;color:white; margin:5px;'>".$row['grade']."</span>";
                
}
else if($row['grade']=='E'){
      echo "<span style='background-color:darkred;padding:10px;color:white; margin:5px;'>".$row['grade']."</span>";
                
}

else if($row['grade']=='CD'){
      echo "<span style='background-color:grey;padding:10px;color:white; margin:5px;'>".$row['grade']."</span>";
                
}
else if($row['grade']=='C'){
      echo "<span style='background-color:orange;padding:10px;color:white; margin:5px;'>".$row['grade']."</span>";
                
}

?>
            </td>

            
                

            </td>
</tr>
    <?php
    $i+=1;
}

           ?>
        </tbody>
    </table>

    <div class="summary">
        <hr>
        <p class="mark"><strong>Total Marks Obtained:</strong>  <?php echo $total; ?> out of 1300</p><hr>
<p><strong>Average:</strong>   <?php echo number_format($average_score,2);?></p>
        <hr>
        <p class="percentage"><strong>Percentage:</strong> <?php echo number_format($average_score,1); ?>%</p>
        <hr>
        <p class="status"><strong>Status:</strong> <span class="pass"><?php
        if($average_score>=50){
            echo "<strong>Pass</strong>";
        }else{
                  echo "<strong>Failed</strong>";
        }
        
        ?></span></p>
        <hr>
          <p class="t-comment"><strong>Teacher's Comment:</strong> <span class="pass"><?php echo $row3['teacher_comment']; ?></span></p>
          <hr>
            <p class="p-comment"><strong>Principal's Comment:</strong> <span class="pass"><?php echo $row3['principal_comment']; ?></span></p>
    </div>
    <button type='button' class='print'>Print</button>
       <a href="student-result.php">Back</a>
</div>
<script src="jquery.min.js">
    
</script>
<script>
    const print= document.querySelector('.print');
    print.addEventListener('click', function(){
window.print();
    });
//     $('.name').on('change',function(){
//         $('.student').val($(this).val());
// $.ajax({
//     url:'get_student.php',
//     type:'POST',
//     data:'name='+$(this).val(),
//     success:function(resp){
//         let d= JSON.parse(resp);
//         console.log(d.name);
//         $('.name').text(d.name);
//           $('.class').text(d.class);
//              $('.roll').text(d.id);
//     }
// })
//     });
</script>
</body>
</html>
