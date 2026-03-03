<?php 
require '../admin/config.php';
$sql=$conn->query('SELECT * FROM settings');
if($sql->num_rows>0){
    $school=$sql->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $scool['school_name'];?></title>
</head>
<body>
    
</body>
</html>