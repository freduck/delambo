
<?php 
require "config.php";
$select=$conn->query("SELECT * FROM subject");

$select_5=$conn->query("SELECT * FROM settings");
$school=$select_5->fetch_assoc();
if(isset($_GET['name'])){
    $name=$_GET['name'];
$select_2=$conn->query("SELECT * FROM result WHERE student_name='$name'");
$row3=$select_2->fetch_assoc();
    $select4=$conn->query("SELECT * FROM result WHERE student_name='$name'");
    $select_3=$conn->query("SELECT students.*,result.* FROM students JOIN result ON students.name=result.student_name WHERE name='$name'");
    $row2=$select_3->fetch_assoc();
    // echo "<img src='admin/".$row2['image']."'>";
}else{
    $name='';
}

if(isset($_POST['add_comment'])){
    extract($_POST);
    $add=$conn->query("UPDATE result SET teacher_comment='$teacher_comment', principal_comment='$principal_comment' WHERE student_name='$name'");
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
            background-color: crimson;
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
            font-weight: bold;
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
            button.print,button.comment{
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
                  margin-top: 10%;
               }
               nav{
                display:none;
               }
               div.comment,div.admin-container{
                display: none;
               }
        }div.comment{
            /*display: none;*/
            padding:10px;
        }textarea{
            padding: 10px;
        }.result-card{
            display: block;
        }.comment{
            font-size: 12px;
        }
    </style>
</head>
<body>

    <br>
<a href="dashboard.php?url=view-students">Refresh</a>
    <br>
<div class="result-card">
    <hr>
    <h1 style="text-align: center; color: darkred;">
        <?php echo $school['school_name'];?>
    </h1>
        <div style="text-align:center;color: darkred;"><strong style="text-align:center; color: darkred;">School Address:</strong><?php echo $school['address'];?>
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
    <p><strong>Class:</strong> <p class="class">
        <?php echo $row2['class'];?>
            
        </p> </p>
    </p>
</div>
<div class="right">
    <img src="<?php echo $row2['image'];?>" alt="">
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
      echo "<span style='background-color:cadetblue;padding:10px;color:white; margin:5px;'>".$row['grade']."</span>";
                
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
        <p><strong>Total Marks:</strong>  <?php ?></p>
        <p><strong>Percentage:</strong> <?php ?></p>
        <p><strong>Status:</strong> <span class="pass"><?php ?></span></p>

          <p><strong>Teacher's Comment:</strong> <span class="comment"><?php echo $row3['teacher_comment']; ?></span></p>
            <p><strong>Principal's Comment:</strong> <span class="comment"><?php echo $row3['principal_comment']; ?></span></p>
    </div>
    <button type='button' class='print'>Print</button>
   
</div>
<script src="jquery.min.js">
    
</script>
<script>
    const print= document.querySelector('.print');
    print.addEventListener('click', function(){
window.location='../get_student_result.php?name=<?php echo $row3['student_name'];?>';
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
