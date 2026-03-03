<?php

require "admin/config.php";
if ($conn->connect_error) {
  die(json_encode(['error' => 'Database connection failed']));
}


$query = isset($_POST['send']) ? $conn->real_escape_string(trim($_POST['send'])) : '';


$sql = "SELECT *
        FROM exam
        ORDER BY DSC
        ";

$result = $conn->query($sql);

if (!$result) {
  die(json_encode(['error' => 'Query failed: ' . $conn->error]));
}


$properties = [];
while ($row = $result->fetch_assoc()) {
  $properties[] = $row;
}


$conn->close();


header('Content-Type: application/json');
echo json_encode($properties);
?>