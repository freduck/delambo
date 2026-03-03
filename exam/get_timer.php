


<?php
// Connect to the database
// $mysqli = new mysqli("localhost", "username", "password", "database_name");
require "admin/config.php";

// Check connection

session_start();
// Start the timer
if (isset($_POST['start_timer'])) {
  $query = "INSERT INTO timers (start_time, status) VALUES (CURRENT_TIMESTAMP, 'running')";
  $conn->query($query);
  $timer_id = $mysqli->insert_id;
  $_SESSION['timer_id'] = $timer_id;
}

// Stop the timer
if (isset($_POST['stop_timer'])) {
  $timer_id = $_SESSION['timer_id'];
  $query = "UPDATE timers SET end_time = CURRENT_TIMESTAMP, status = 'stopped' WHERE id = $timer_id";
 $conn->query($query);
  $query = "SELECT TIMESTAMPDIFF(SECOND, start_time, end_time) AS duration FROM timers WHERE id = $timer_id";
  $result = $conn->query($query);
  $row = $result->fetch_assoc();
  $duration = $row['duration'];
  $query = "UPDATE timers SET duration = $duration WHERE id = $timer_id";
  $conn->query($query);

 $_SESSION['timer_id']=$timer_id;
 $tid=$_SESSION['timer_id'];
// Get the timer duration
$query = "SELECT duration FROM timers WHERE id ='$tid'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$duration = $row['duration'];
echo "<h1>Timer: $duration seconds</h1>";
}
// Display the timer

// Form to start and stop the timer
echo "<form method='post'>";
echo "<button name='start_timer'>Start Timer</button>";
echo "<button name='stop_timer'>Stop Timer</button>";
echo "</form>";

$conn->close();
?>