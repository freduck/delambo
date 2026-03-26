<?php 
require "config.php";
$select=$conn->query("SELECT * FROM subject");
$select_3=$conn->query("SELECT * FROM students");
$select_2=$conn->query("SELECT * FROM result");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Form</title>
    <script src="../jquery.min.js"></script>   
    <style>
        select{
            padding: 4px;
            text-transform: uppercase;
            width: 100%;
               border: 1px solid whitesmoke;
        }
h1{
    text-align: center;
}
        input[type='number'],input[type='text']{
            padding: 4px;
             width: 100%;
                border: 1px solid whitesmoke;
        }
        .result-panel{
            width:500px;
            border:1px solid whitesmoke;
            margin: 0 auto;
            box-shadow: rgba(99,99,99,.05)2px 2px 2px 2px;
            padding: 20px;
        }
        button[type='submit']{
            padding: 10px;
            border: 1px solid whitesmoke;
        }
        form{
            display:flex;
            gap: 30px;
            padding: 30px;
        }
        option{
            padding:30px;
        }
    </style>                                           
</head>
<body>
    <br>
  
    <br>
    <div class="result-panel">
        
    <h1>Student Result Form</h1>
    <form class="result-form">
        <div class="">

        <select class="name" name="name">
            <option value="">Select Student</option>
            <?php 
while($row=$select_3->fetch_assoc()){
            ?>
<option><?php echo $row['name'];?></option>
        <?php 
    }
    ?>
        </select><br><br>
   
        <select name="subject" class="subject">
            <option value="">Select Subject</option>
            <?php
while($row=$select->fetch_assoc()){

             ?>
<option>
            <?php 

echo $row['subject_name'];
            ?>
</option>
            <?php 
}

            ?>
        </select><br><br>
    
        <input type="number" class="test_1" name="test_1" placeholder="Test 1"><br><br>
    
        <input type="number" class="test_2" name="test_2" placeholder="Test 2"><br><br>
    
    </div>
    <div class="">
        <input type="number" class="ca_total" name="ca_total" placeholder="Total C.A"><br><br>
          <input type="number" class="exam" name="exam" placeholder="Exam"><br><br>
   
        <input type="number" class="total_score" name="total_score" placeholder="Total Score"><br><br>
   
        <input type="text" class="grade" name="grade" placeholder="Grade"><br><br>

        
        <select name="term" required class="term">
            <option value="">Term</option>
            <option value="FIRST"> FIRST</option>
            <option value="SECOND">SECOND</option>
            

        </select><br><br>

        <button type="submit">Submit</button>
    </div>
    </form>
<a href="../student-result.php">View</a>
    </div>
    <script>
        function createGrade(x){
            let grade;
            if(x<=39){
grade='F';

            }


            else if(x<=45 && x>39){
grade='E';

            }
else if(x<=49 && x>45){
grade='E';

            }

            else if(x<=55 && x>=45){
grade='D';

            }
            else if(x<=59 && x>=55){
grade='BC';

            }
             else if(x<=55 && x>=50){
grade='C';

            }
            else if(x<=69 && x>=60){
grade='B';

            }
              else if(x<=75 && x>=70){
grade='AB';

            }
            else if(x<=100 && x>=75){
grade='A';

            }
            return grade;
        }
          createGrade(47)
        $(document).ready(function() {
            document.querySelector('.test_2').addEventListener('input',function(){
            document.querySelector('.ca_total').value= parseFloat(document.querySelector('.test_1').value) + parseFloat(this.value);
            });
            document.querySelector('.exam').addEventListener('input',function(){
          let total=parseFloat(document.querySelector('.ca_total').value) + parseFloat(this.value);
                document.querySelector('.total_score').value=total;
          
                document.querySelector('.grade').value=   createGrade(total);

            });


         $('.result-form').on('submit',function(e){
e.preventDefault();
         
                var formData = {
                    name:$('.name').val(),
                    subject:$('.subject').val(),
                    test_1:$('.test_1').val(),            
                    test_2:$('.test_2').val(),
                    ca_total:$('.ca_total').val(),                 
                    exam:$('.exam').val(),
                    total_score:$('.total_score').val(),                   
                    grade:$('.grade').val()
                    term: $('.term').val()              
                };
                $.ajax({
                    type: 'POST',
                    url: 'upload_result.php',                                
                    data:'name='+ formData.name+'&subject='+formData.subject+'&test_1='+formData.test_1+'&test_2='+formData.test_2+'&ca_total='+formData.ca_total+'&exam='+formData.exam+'&total_score='+formData.total_score+'&grade='+formData.grade+'term='+formData.term,
                    success: function(response) {
                        console.log(response);
                        alert('Data sent successfully!');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Error sending data!');
                    }
                });
            });
        });
    </script>
</body>
</html>

