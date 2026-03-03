<div class="container">
    <form action="upload_question" method="post">
    <div class="form-group">
        <textarea name="question" id="question" placeholder='Enter Questions'></textarea>
    </div>
    <div class="form-group">
        <select name="subject" id="subject">
            <option value="">Select Subject</option>
            <?php 
            require "config.php";
$select=$conn->query("SELECT * FROM `subject`");
if($select->num_rows>0){
while($row=$select->fetch_assoc()){

?>

<option value="<?php echo $row['id'];?>"><?php echo $row['subject_name'];?></option>

<?php 
}
}else{
    echo "nill";
}
?>
        </select>
    </div>
    <div class="form-group">
        <input type='text' name='option_1' placeholder='Enter First Option' id='option_1'>
    </div>
    <div class="form-group">
   <input type="text" name='option_2' placeholder='Enter Option Two' id='option_2'>
    </div>
    <div class="form-group">
   <input type="text" name='option_3' placeholder='Enter Option Three' id='option_3'>
    </div>
    <div class="form-group">
   <input type="text" name='option_4' placeholder='Enter Option Four' id='option_4'>
    </div>
     <div class="form-group">
   <input type="text" name='answer' placeholder='Answer' id='answer'>
    </div>
    <div class="form-group">    
        <button type='submit' id='add'>Add Question</button>
    </div>
    <div class="form-group">    
        <button type='reset' id='reset'>Reset Question</button>
    </div>
</form>
</div>
<script src='../js/jquery.min.js'></script>
<script>
$('#add').on('click',function(){
$.ajax({
    url:'upload_question.php',
    type:'POST',
    data:'subject=',
    // +$('#subject').val()+'&question='+$('#question').val()+'&option_1='+$('#option_1').val()+'&option_2='+$('#option_2').val()+'&option_3='+$('#option_3').val()+'&option_4='+$('#option_4').val(),
    successs:function(response){
        console.log(response);
    },error:function(error){console.log(error);
}
});

});
</script>
<style>
    .container{
        width:500px;
        padding:40px;
        margin:0 auto;
    }
    input[type='text'],select,button,textarea{
        padding:10px;
        margin:10px;
    }
</style>