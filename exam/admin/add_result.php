<?php
// Database configuration
$host = 'localhost'; $db = 'de_lambo'; $user = 'root'; $pass = '';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (\PDOException $e) { die("Connection failed: " . $e->getMessage()); }

$message = "";

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['student_name'];
    $subject = $_POST['subject'];
    $term = $_POST['term'];
    $t1 = (float)$_POST['test_1'];
    $t2 = (float)$_POST['test_2'];
    // $ca_total= (float)$_POST['ca_total'];
    $exam = (float)$_POST['exam'];

    // 1. Calculations
    $ca_total = $t1 + $t2;
    $total = $ca_total + $exam;

    // 2. Determine Grade based on BC scale
    if ($total >= 80) $grade = "A";
    elseif ($total >= 70) $grade = "B";
    elseif ($total >= 65) $grade = "BC";
    elseif ($total >= 60) $grade = "C";
    elseif ($total >= 50) $grade = "D";
    elseif ($total >= 40) $grade = "E";
    else $grade = "F";

    $t_comment = $_POST['teacher_comment'];
    $p_comment = $_POST['principal_comment'];
    
    // Image placeholder (Simple version)
    $image = "default.png"; 

    try {
        $sql = "INSERT INTO second_term (student_name, subject, term, test_1, test_2, ca_total, exam, total, grade, teacher_comment, principal_comment, image) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $subject, $term, $t1, $t2, $ca_total, $exam, $total, $grade, $t_comment, $p_comment, $image]);
        $message = "<div class='alert success'>Result for $name added successfully! Total: $total (Grade: $grade)</div>";
    } catch (Exception $e) {
        $message = "<div class='alert error'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student Result</title>
    <style>
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; padding: 40px; }
        .form-container { max-width: 600px; background: white; padding: 30px; margin: 0 auto; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #1e293b; }
        .input-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; font-size: 0.9rem; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        button { width: 100%; background: #2563eb; color: white; padding: 12px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        button:hover { background: #1d4ed8; }
        .alert { padding: 15px; border-radius: 6px; margin-bottom: 20px; text-align: center; }
        .success { background: #dcfce7; color: #166534; }
        .error { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add New Result</h2>
    <?= $message ?>
    <form method="POST">
        <div class="input-group">
            <label>Student Name</label>
            <input type="text" name="student_name" required placeholder="e.g. John Doe">
        </div>

        <div class="grid-2">
            <div class="input-group">
                <label>Subject</label>
                <input type="text" name="subject" required placeholder="e.g. English">
            </div>
            <div class="input-group">
                <label>Term</label>
                <select name="term">
                    <option value="Second Term">Second Term</option>
                </select>
            </div>
        </div>

        <div class="grid-2">
            <div class="input-group">
                <label>Test 1 (e.g. 15)</label>
                <input type="number" step="0.1" name="test_1" required>
            </div>
            <div class="input-group">
                <label>Test 2 (e.g. 15)</label>
                <input type="number" step="0.1" name="test_2" required>
            </div>
        </div>

        <div class="input-group">
            <label>Exam Score (e.g. 70)</label>
            <input type="number" step="0.1" name="exam" required>
        </div>

        <div class="input-group">
            <label>Teacher's Comment</label>
            <textarea name="teacher_comment" rows="2"></textarea>
        </div>

        <div class="input-group">
            <label>Principal's Comment</label>
            <textarea name="principal_comment" rows="2"></textarea>
        </div>

        <button type="submit">Save Student Result</button>
    </form>
    <p style="text-align: center;"><a href="student_cards.php" style="color: #64748b; font-size: 0.8rem;">View All Records</a></p>
</div>

</body>
</html>