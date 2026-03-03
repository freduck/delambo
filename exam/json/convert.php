<?php

// Load the JSON file
$jsonData = file_get_contents('c.c.a.json');
$data = json_decode($jsonData, true);

// Define the database connection parameters
require "../admin/config.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create a table
$sql = "
    CREATE TABLE IF NOT EXISTS `exam`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(55) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option_1` text DEFAULT NULL,
  `option_2` text DEFAULT NULL,
  `option_3` text DEFAULT NULL,
  `option_4` text DEFAULT NULL,
  `answer` text DEFAULT NULL,
  PRIMARY KEY(id)
)
";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table: " . $conn->error;
}

// Generate SQL statements
$sql_statements = [];
foreach ($data as $item) {
    $question = $conn->real_escape_string($item['question']);
    $option_1 = $conn->real_escape_string($item['options'][0]);
     $option_2 = $conn->real_escape_string($item['options'][1]);
      $option_3 = $conn->real_escape_string($item['options'][2]);
       $option_4 = $conn->real_escape_string($item['options'][3]);
        $correct = $conn->real_escape_string($item['answer']);
    $sql_statement = "INSERT INTO exam (question, option_1,option_2,option_3,option_4,answer) VALUES ('$question','$option_1','$option_2', '$option_3' ,'$option_4' , '$correct');";
    $sql_statements[] = $sql_statement;
}

// Write SQL statements to a file
$file = fopen('data.sql', 'w');
foreach ($sql_statements as $statement) {
    fwrite($file, $statement . "\n");
}
fclose($file);

// Close the connection
$conn->close();

echo "JSON file converted to SQL file successfully!";
?>

